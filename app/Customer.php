<?php

namespace App;

use App\Order;
use App\Facades\ShoppingCart;
use App\Traits\Customer\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Customer extends Model
{
    use HasAttributes;

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
     * Get the customer's attribute.
     *
     * @return boolean
     */
    public function getIsDefaultAttribute()
    {
        return $this->shippings->where('default_address', true)->isEmpty();
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
     * Get the shippings that belong to the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
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
    public function completePurchase($order)
    {
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

    /**
     * Customer has a specific shipping address stored.
     *
     * @param  array  $address | null
     * @return boolean
     */
    public function hasStoredShippingAddress($address = null)
    {
        return $address ? collect($address)->keys()->contains('customer_id') : '';
    }

    /**
     * Add the shipping address to the customer.
     *
     * @param array $data
     * @return \App\Shipping
     */
    public function addShipping(array $data = null)
    {
        $shipping = $data ? Shipping::fromForm($data) : '';

        return $shipping ? $this->shippings()->save($shipping) : '';
    }
}
