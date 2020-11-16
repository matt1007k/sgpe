<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'to' => $faker->email,
        'subject' => $faker->sentence,
        'body' => "## $faker->sentence",
        'user_id' => factory(\App\Models\User::class),
    ];
});
