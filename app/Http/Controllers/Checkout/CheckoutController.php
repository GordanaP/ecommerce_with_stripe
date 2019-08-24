<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use Stripe\Stripe;
use Stripe\Error\Base;
use App\Traits\Payable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    use Payable;

    /**
     * Display a listing of the resource.
     *
     * @param \App\User $user | null
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
     * @param \App\User $user | null
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user = null)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payment_method_id = $request->payment_method_id;
        $payment_intent_id = $request->payment_intent_id;

        try {
            if ($payment_method_id)
            {
                $intent = $this->generatePaymentIntent($payment_method_id);
            }

            if($payment_intent_id)
            {
                $this->retrievePaymentIntent($payment_intent_id);
            }

            return $this->generatePaymentResponse($user, $intent);

        } catch (Base $e) {
            return response([
                'error' => $e->getMessage()
            ]);
        }
    }
}