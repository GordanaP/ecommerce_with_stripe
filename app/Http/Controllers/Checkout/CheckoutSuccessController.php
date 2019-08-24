<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class CheckoutSuccessController extends Controller
{
    /**
     * Display payment success confirmation message.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('checkouts.confirmations.success');
    }
}
