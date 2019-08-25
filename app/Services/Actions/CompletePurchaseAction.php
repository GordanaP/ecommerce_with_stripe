<?php

namespace App\Services\Actions;

use App\Order;
use App\Customer;

class CompletePurchaseAction
{
    /**
     * The customer.
     *
     * @var \App\Customer
     */
    public $customer;

    /**
     * Create a new class instance.
     *
     * @param  \App\Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Complete the order.
     *
     * @param  \Stripe\PaymentIntent $paymentIntent
     * @return  \App\Order
     */
    public function recordPayment($paymentIntent)
    {
        $order = $this->getOrder($paymentIntent);

        return $this->customer->completePurchase($order);
    }

    /**
     * Get the order.
     *
     * @param  \Stripe\PaymentIntent $paymentIntentIntent
     * @return \App\Order
     */
    protected function getOrder($paymentIntent)
    {
        return Order::getFromShoppingCart()
            ->completePayment($paymentIntent);
    }
}
