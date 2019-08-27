<?php

namespace App\Services\UseCases;

use App\Customer;
use App\Services\AbstractClasses\Purchase;

class GuestPurchase extends Purchase
{
    /**
     * Create a new class instance.
     *
     * @param \Stripe\PaymentIntent $paymentIntent
     */
    public function __construct($paymentIntent)
    {
        parent::__construct($paymentIntent);
    }

    /**
     * {@inheritDoc}
     */
    protected function getBillingAddress()
    {
        $data = $this->billingAddress();

        return Customer::create($data);
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
