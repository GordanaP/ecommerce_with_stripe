<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street_address' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
    ];
});
