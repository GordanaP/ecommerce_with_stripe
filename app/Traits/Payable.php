<?php

namespace App\Traits;

use App\Order;
use Keygen\Keygen;
use Stripe\PaymentIntent;
use App\Facades\ShoppingCart;
use Illuminate\Support\Facades\Session;

trait Payable
{
    /**
     * Create Stripe Payment Intent.
     *
     * @param  string $paymentMethodId
     * @return \Stripe\PaymentIntent
     */
    public function generatePaymentIntent($paymentMethodId)
    {
        return PaymentIntent::create(
            $this->getIntentAttributes($paymentMethodId),
            $this->getIdempotencyKey()
        );
    }

    /**
     * Retrieve Stripe Payment Intent.
     *
     * @param  string $paymentMethodId
     */
    public function retrievePaymentIntent($paymentMethodId)
    {
        $intent = PaymentIntent::retrieve($paymentMethodId);
        $intent->confirm();
    }

    /**
     * Generate payment response.
     *
     * @param  \App\User $user
     * @param  \Stripe\PaymentIntent $intent
     * @return mixed
     */
    protected function generatePaymentResponse($user, $intent)
    {
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'use_stripe_sdk') {
            return response([
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ]);
        } else if ($intent->status == 'succeeded') {

            $order = Order::getFromShoppingCart()
                ->completePayment($intent);

            $user->customer->placeOrder($order);

            ShoppingCart::fromSession()->destroy();
            Session::regenerate();

            return response([
                'success' => route('checkouts.success')
            ]);
        } else {
            return response([
                'error' => route('checkouts.error')
            ]);
        }
    }

    /**
     * Get Stripe Payment Intent Attributes.
     *
     * @param  string $paymentMethodId
     * @return array
     */
    protected function getIntentAttributes($paymentMethodId)
    {
        $intent = [];
        $orderId = $this->generateStripeOrderId();

        $intent['payment_method'] = $paymentMethodId;
        $intent['amount'] = ShoppingCart::fromSession()->getTotalInCents();
        $intent['currency'] = 'usd';
        $intent['metadata'] = ['order_id' => $orderId];
        $intent['confirmation_method'] = 'manual';
        $intent['confirm'] = true;

        return $intent;
    }

    /**
     * Generate idempotency key.
     *
     * @return string
     */
    protected function getIdempotencyKey()
    {
        return [ 'idempotency_key' => Session::getId()];
    }

    /**
     * Generate stripe order id.
     *
     * @return string
     */
    protected function generateStripeOrderId()
    {
        return Keygen::numeric(7)->prefix('#')->generate(true);
    }
}
