<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'paternal_surname' => $faker->lastName,
        'maternal_surname' => $faker->lastName,
        'dni' => (string) rand(111111111, 999999999),
        'modular_code' => (string) rand(1111111111, 9999999999),
        'status' => $faker->randomElement(["activo", "cesante", "sobreviviente"]),
        'user_id' => factory(\App\Models\User::class),
    ];
});
