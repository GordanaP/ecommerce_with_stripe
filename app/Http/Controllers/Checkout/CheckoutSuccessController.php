<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class CheckoutSuccessController extends Controller
{
    public function __invoke()
    {
        return view('checkouts.confirmations.success');
    }
}
