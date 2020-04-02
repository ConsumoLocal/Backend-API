<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\UserBusiness::class, function (Faker $faker) {
    $user = \App\User::orderByRaw("RAND()")->first();
    $business = \App\User::orderByRaw("RAND()")->first();
    return [
        'user_id' => $user->id,
        'business_id' => $business->id
    ];
});
