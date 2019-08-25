<?php

namespace App\Services\AbstractClasses;

use App\Services\Actions\CompletePurchaseAction;

abstract class Purchase
{
    /**
     * The paymentIntent.
     *
     * @var \Stripe\PaymentIntent
     */
    public $paymentIntent;

    /**
     * Create a new class instance.
     *
     * @param \Stripe\PaymentIntent $paymentIntent
     */
    public function __construct($paymentIntent)
    {
        $this->paymentIntent = $paymentIntent;
    }

    /**
     * Handle the purchase.
     *
     * @return \App\Order
     */
    final public function handle()
    {
        $customer = $this->getBillingAddress();
        $shipping = $this->getShippingAddress($customer);

        return (new CompletePurchaseAction($customer))->record($shipping, $this->paymentIntent);
    }

    /**
     * Get the billing address.
     *
     * @return  \App\Customer
     */
    abstract protected function getBillingAddress();

    /**
     * Get the shipping address.
     *
     * @param  \App\Customer $customer
     * @return int|null
     */
    abstract protected function getShippingAddress($customer);

    /**
     * Get the billing address.
     *
     * @return  mixed
     */
    abstract protected function billingAddress();

    /**
     * Get the shipping address.
     *
     * @return  mixed
     */
    abstract protected function shippingAddress();
}
