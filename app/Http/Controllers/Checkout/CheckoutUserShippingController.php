<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutUserShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Shipping $shipping = null)
    {
        return view('checkouts.index')->with([
            'user' => $user,
            'shipping' => $shipping ?: $user->customer,
            'default_delivery' => '',
        ]);
    }
}
