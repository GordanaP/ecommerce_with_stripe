<?php

namespace App\Services\UseCases;

use App\User;
use App\Services\AbstractClasses\Purchase;

class AuthUserPurchase extends Purchase
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
        $customer = $this->billingAddress();

        return $this->user->addCustomer($customer);
    }

    /**
     * {@inheritDoc}
     */
    protected function getShippingAddress($customer)
    {
        $shipping = $this->shippingAddress();

        return optional($customer->addShipping($shipping))->id;
    }

    /**
     * {@inheritDoc}
     */
    protected function billingAddress()
    {
        return request('address.billing');
    }

    /**
     * {@inheritDoc}
     */
    protected function shippingAddress()
    {
        return request('address.shipping');
    }
}
