<?php

namespace App;

use Keygen\Keygen;
use App\Facades\ShoppingCart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number', 'subtotal_in_cents', 'tax_amount_in_cents', 'shipping_costs_in_cents',
        'total_in_cents', 'stripe_payment_id', 'paid'
    ];

    /**
     * Get the customer that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Cusomer::class);
    }

    /**
     * Get the products that belong to the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->as('from_cart')
            ->withPivot('quantity', 'price_in_cents');
    }

    /**
     * Get the order price summary from the shopping cart.
     *
     * @return \App\Order
     */
    public static function getFromShoppingCart()
    {
        $orderSummary = ShoppingCart::fromSession()->getSummary()->toArray();

        return (new static)->fill($orderSummary);
    }

    /**
     * Complete order with stripe payment id.
     *
     * @param  \Stripe\PaymentIntent $intent
     * @return \App\Order
     */
    public function completePayment($intent)
    {
        $this->order_number = $intent->metadata['order_id'];
        $this->stripe_payment_id = $intent->id;
        $this->paid = true;

        return $this;
    }

    /**
     * Attach the items to the order.
     */
    public function attachItems()
    {
        ShoppingCart::fromSession()->getItems()->map(function($item, $key) {
            $this->products()->attach($item->id, [
                'quantity' => $item->quantity,
                'price_in_cents' => $item->price_in_cents
            ]);
        });
    }
}
