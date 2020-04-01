<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'imageUrl' => $faker->url,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'website' => $faker->url,
        'email' => $faker->email,
        'preferredLink' => $faker->url,
    ];
});
