<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class CheckoutErrorController extends Controller
{
    /**
     * Display payment error confirmation message.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('checkouts.confirmations.error');
    }
}
