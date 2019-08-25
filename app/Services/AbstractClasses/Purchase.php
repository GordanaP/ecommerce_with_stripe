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

        return (new CompletePurchaseAction($customer))->recordPayment($this->paymentIntent);
    }

    /**
     * Get the billing address.
     *
     * @return  \App\Customer
     */
    abstract protected function getBillingAddress();

    /**
     * Get the address.
     *
     * @return  mixed
     */
    abstract protected function billingAddress();
}
