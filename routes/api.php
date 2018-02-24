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
  });
});

$router->get('/tickets', function () use ($router) {
    $tickets = \App\Ticket::with(['notes', 'owners', 'creator'])->get();
    return $tickets;
});

$router->get('/users', function () use ($router) {
    $users = \App\User::all();
    return $users;
});
