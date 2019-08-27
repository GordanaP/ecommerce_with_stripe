<?php

namespace App\Services\Factories;

use App\User;
use App\Services\UseCases\GuestPurchase;
use App\Services\UseCases\AuthUserPurchase;
use App\Services\UseCases\CustomerPurchase;

class PurchaseFactory
{
    /**
     * Create the purchase.
     *
     * @param  \App\User $user
     * @param  \Stripe\PaymentIntent $paymentIntent
     * @return mixed
     */
    public function createPurchase(User $user = null, $paymentIntent)
    {
        if(! $user) {
            return (new GuestPurchase($paymentIntent))->handle();
        }

        if(! $user->hasProfile()) {
            return (new AuthUserPurchase($user, $paymentIntent))->handle();
        }

        return (new CustomerPurchase($user, $paymentIntent))->handle();
    }
}
