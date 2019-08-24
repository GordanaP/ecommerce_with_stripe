<?php

use App\Order;
use App\Product;
use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::first();
        $product1 = Product::first();
        $product2 = Product::find(2);

        collect([$product1, $product2])->values()->map(function($product, $key) use($order) {
            $order->products()->attach($product->id, [
                'quantity' => 1,
                'price_in_cents' => $product->price_in_cents
            ]);
        });
    }
}
