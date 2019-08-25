<?php

namespace App;

use App\Order;
use App\Facades\ShoppingCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'street_address', 'postal_code',
        'city', 'country', 'phone'
    ];

    /**
     * Get the full_name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' '. $this->last_name;
    }

    /**
     * Get the postal_code attribute.
     *
     * @return string
     */
    public function getPostalCodeCityAttribute()
    {
        return $this->postal_code . ' '. $this->city;
    }

    /**
     * Get the user that owns the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    /**
     * Get the orders that belong to the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Place order.
     *
     * @param  \App\Order $order
     * @return \App\Order
     */
    public function placeOrder($order)
    {
        return $this->orders()->save($order);
    }

    /**
     * Complete the purchase.
     *
     * @param  \Stripe\PaymentIntent $paymentIntent
     */
    public function completePurchase($paymentIntent)
    {
        $order = Order::getFromShoppingCart()->completePayment($paymentIntent);

        $this->placeOrder($order)->attachItems();

        ShoppingCart::fromSession()->destroy();
        Session::regenerate();
    }

    /**
     * Get data from form.
     *
     * @param  array $data
     * @return \App\Customer
     */
    public static function getFromForm(array $data)
    {
        return (new static)->fill($data);
    }
}
