<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Order;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'order_number' => $faker->numberBetween($min = 1000, $max = 10000),
        'customer_id' => Customer::first()->id,
        'subtotal_in_cents' => $subtotal_in_cents = $faker->numberBetween($min = 500, $max = 2000),
        'tax_amount_in_cents' => $tax_amount_in_cents = $subtotal_in_cents * config('cart.tax_rate'),
        'shipping_costs_in_cents' => $shipping_costs_in_cents = $subtotal_in_cents * 0.1,
        'total_in_cents' => $subtotal_in_cents + $tax_amount_in_cents + $shipping_costs_in_cents,
        'stripe_payment_id' => $faker->md5,
        'paid' => true
    ];
});
