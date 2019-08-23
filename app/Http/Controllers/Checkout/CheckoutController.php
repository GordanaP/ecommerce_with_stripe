<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use Stripe\Stripe;
use Stripe\Error\Base;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user = null)
    {
        return view('checkouts.index')->with([
            'user' => $user ?? ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payment_method_id = $request->payment_method_id;
        $payment_intent_id = $request->payment_intent_id;
        $intent = null;

        try {
            if ($payment_method_id)
            {
                $intent = PaymentIntent::create([
                    'payment_method' => $payment_method_id,
                    'amount' => ShoppingCart::fromSession()->getTotalInCents(),
                    'currency' => 'usd',
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                ],
                [
                    'idempotency_key' => Session::getId()
                ]);
            }

            if($payment_intent_id)
            {
                $intent = PaymentIntent::retrieve($payment_intent_id);
                $intent->confirm();
            }

            return $this->generatePaymentResponse($intent);

        } catch (Base $e) {
            return response([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Generate payment response.
     *
     * @param  PaymentIntent obkect
     * @return mixed
     */
    protected function generatePaymentResponse($intent)
    {
        if ($intent->status == 'requires_action' &&
        $intent->next_action->type == 'use_stripe_sdk') {
            return response([
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ]);
        } else if ($intent->status == 'succeeded') {

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
}
