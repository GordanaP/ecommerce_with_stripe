<?php

namespace App;

use Keygen\Keygen;
use App\Facades\ShoppingCart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'subtotal_in_cents', 'tax_amount_in_cents', 'shipping_costs_in_cents',
        'total_in_cents', 'stripe_payment_id', 'paid'
    ];

    public function customer()
    {
        return $this->belongsTo(Cusomer::class);
    }

    public static function getFromShoppingCart()
    {
        $orderSummary = ShoppingCart::fromSession()->getSummary()->toArray();

        return (new static)->fill($orderSummary);
    }

    public function completePayment($intent)
    {
        $this->order_number = $intent->metadata['order_id'];
        $this->stripe_payment_id = $intent->id;
        $this->paid = true;

        return $this;
    }
}
