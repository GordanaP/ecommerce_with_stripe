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
     * Complete the purcahse.
     *
     * @param  integer $shipping
     * @param  \Stripe\PaymentIntent $paymentIntent
     * @return  \App\Order
     */
    public function record($shipping, $paymentIntent)
    {
        $order = $this->getOrder($shipping, $paymentIntent);

        return $this->customer->completePurchase($order);
    }

    /**
     * Get the order.
     *
     * @param  integer $shipping
     * @param  \Stripe\PaymentIntent $paymentIntentIntent
     * @return \App\Order
     */
    protected function getOrder($shipping, $paymentIntent)
    {
        return Order::getFromShoppingCart()
            ->completeShipping($shipping)
            ->completePayment($paymentIntent);
    }
}
