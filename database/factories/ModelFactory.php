<?php
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $gender = $faker->randomElements(['male', 'female']);
    return [
        'name' => $faker->name($gender[0]),
        'email' => $faker->email,
        'gender' => $gender[0]
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {
    $gender = $faker->randomElements(['male', 'female']);
    return [
      'title' => $faker->word,
      'description' => $faker->paragraph,
      'department' => $faker->randomElements([1,2,3,4])[0],
      'category' => $faker->randomElements([1,2,3,4,5,6,7])[0],
      'status' => $faker->randomElements(\App\Ticket::STATUES)[0],
      'priority' => $faker->randomElements(\App\Ticket::PRIORITIES)[0],
      'client' => null,
      'room' => null,
      'asset' => null,
      'startDate' => $faker->boolean ? Carbon::now()->addWeeks($faker->randomDigitNotNull) : Carbon::now(),
      'endDate' => $faker->boolean ? Carbon::now()->addDays($faker->randomDigitNotNull) : Carbon::now(),
      'dueDate' => $faker->boolean ? Carbon::now() : null,
      'closedDate' => $faker->boolean ? Carbon::now() : null
    ];
});

$factory->define(App\Note::class, function (Faker\Generator $faker) {
  $creator = factory(\App\User::class)->create();
    return [
        'text' => $faker->text,
        'workTime' => $faker->randomDigitNotNull(0,9),
        'driveTime' => $faker->randomDigitNotNull(0,9),
        'billable' => $faker->boolean,
        'mileage' => $faker->randomDigitNotNull(0,250),
        'private' => $faker->boolean,
        'resolving' => $faker->boolean,
        'creator' => $creator
    ];
});
