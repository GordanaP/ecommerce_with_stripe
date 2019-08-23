<?php

namespace App\Http\Controllers\Cart;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user = null)
    {
        $cartItems = ShoppingCart::fromSession();

        return view('carts.index')->with([
            'user' =>  $user ?? '',
            'cartItems' => $cartItems
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\QuantityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        ShoppingCart::fromSession()->add($product, $request->quantity ?? 1);

        return back()->with('success', 'The selected product has been added to cart.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\QuantityRequest  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|between: 1,5'
        ]);

        ShoppingCart::fromSession()->update($product, $request->quantity);

        return back()->with('success', 'The selected quantity has been updated.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        ShoppingCart::fromSession()->remove($product->id);

        return back()->with('success', 'The selected product has been removed from cart.');;
    }

    /**
     * Remove all items from the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function empty()
    {
        ShoppingCart::fromSession()->destroy();

        return redirect()->route('carts.index')->with('success', 'The cart is empty now.');;
    }
}
