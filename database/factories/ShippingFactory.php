<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Customer;
use App\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street_address' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => 'rs',
        'phone' => $faker->phoneNumber,
        'customer_id' => Customer::first()->id,
    ];
});
