<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {
    $user = \App\User::all()->first();
    $city = \App\City::all()->random();
    return [
        'user_id'       => $user->id,
        'name'          => $faker->companySuffix,
        'description'   => $faker->text,
        'imageUrl'      => $faker->url,
        'address'       => $faker->address,
        'email'         => $faker->unique()->companyEmail,
        'preferredLink' => $faker->url,
        'latitude'      => $faker->latitude,
        'longitude'     => $faker->longitude,
        'city'          => $city->id
    ];
});
