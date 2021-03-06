<?php

namespace App\Services\UseCases;

use App\User;
use App\Services\AbstractClasses\Purchase;

class CustomerPurchase extends Purchase
{
    /**
     * The user.
     *
     * @var \App\User
     */
    public $user;

    /**
     * Create a new class instance.
     *
     * @param \App\User $user
     * @param \Stripe\PaymentIntent $paymentIntent
     */
    public function __construct(User $user, $paymentIntent)
    {
        $this->user = $user;

        parent::__construct($paymentIntent);
    }

    /**
     * {@inheritDoc}
     */
    protected function getBillingAddress()
    {
        return $this->billingAddress();
    }

    /**
     * {@inheritDoc}
     */
    protected function getShippingAddress($customer)
    {
        $shipping = $this->shippingAddress();

        return $shipping && $customer->hasStoredShippingAddress($shipping) ? $shipping['id'] : null;
        // return optional($this->shippingAddress())['id'];
    }

    /**
     * {@inheritDoc}
     */
    protected function billingAddress()
    {
        return $this->user->customer;
    }

    /**
     * {@inheritDoc}
     */
    protected function shippingAddress()
    {
        return request('address.shipping');
    }
}
