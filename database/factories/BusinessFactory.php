<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {
    $user = \App\User::all()->first();
    return [
        'user_id' => $user->id,
        'name' => $faker->companySuffix,
        'description' => $faker->text,
        'imageUrl' => $faker->url,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'website' => $faker->url,
        'email' => $faker->unique()->companyEmail,
        'preferredLink' => $faker->url,
    ];
});
