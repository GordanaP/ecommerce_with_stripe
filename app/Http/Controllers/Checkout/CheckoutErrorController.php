<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class CheckoutErrorController extends Controller
{
    public function __invoke()
    {
        return view('checkouts.confirmations.error');
    }
}
