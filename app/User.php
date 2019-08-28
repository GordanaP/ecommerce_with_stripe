<?php

namespace App;

use App\Customer;
use App\Traits\User\HasAddress;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasAddress;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the customer that belongs to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Get all of the shipping addresses for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function shippings()
    {
        return $this->hasManyThrough('App\Shipping', 'App\Customer');
    }

    /**
     * Dteremine if the user has profile.
     *
     * @return boolean
     */
    public function hasProfile()
    {
        return $this->customer;
    }

    /**
     * Add the customer's profile.
     *
     * @param array $data
     * @return \App\Customer
     */
    public function addCustomer(array $data)
    {
        $customer = Customer::getFromForm($data);

        return $this->customer()->save($customer);
    }

    /**
     * Get shipping address on checkout.
     *
     * @param  \App\Shipping $shipping
     * @return mixed
     */
    public function getCheckoutShippingAddress($shipping = null)
    {
        return $shipping ?: $this->getDefaultAddress();
    }
}
