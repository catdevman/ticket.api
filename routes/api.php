<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('generateTickets', function() use($router){
  $tickets = collect(
  factory(\App\Ticket::class, 10)->create()->each(function($ticket){
    $notes = factory(\App\Note::class, rand(1,5))->make();
    $notes->each(function($note) use ($ticket){
      $ticket->notes()->save($note);
    });
    $owners = factory(\App\User::class, rand(1,5))->make();
    $creator = factory(\App\User::class)->create();
    $ticket->owners()->saveMany($owners);
    $ticket->creator()->save($creator);
    $ticket->save();
  }));
  return $tickets;
});

$router->get('/tickets', function () use ($router) {
    $tickets = \App\Ticket::with(['notes', 'owners', 'creator'])->get();
    return $tickets;
});

$router->get('/tickets/{id}', function ($id) use ($router) {
    $ticket = \App\Ticket::with(['notes', 'owners', 'creator'])->find($id);
    return $ticket;
});

$router->post('/tickets', function (\Illuminate\Http\Request $request) use ($router) {
    $data = $request->json()->all();
    $owners = $data['owners'] ?? null;
    unset($data["owners"]);
    $creator = $data["creator"];
    unset($data["creator"]);
    $ticket = new \App\Ticket($data);
    $ticket->save();
    $owners = collect($owners)->pluck("_id");
    $owners = \App\User::find($owners);
    $ticket->owners()->saveMany($owners);
    $ticket->creator()->save(\App\User::find($creator)->first());
    $ticket = \App\Ticket::with(['notes', 'owners', 'creator'])->find($ticket->_id);
    return $ticket;
});

$router->get('/users', function () use ($router) {
    $users = \App\User::all();
    return $users;
});
