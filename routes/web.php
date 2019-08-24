<?php

Route::get('/test/{user?}', 'TestController@index')->name('test.index');
Route::post('/test/{user?}', 'TestController@store')->name('test.store');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Product
 */
Route::get('/products', 'Product\ProductController@index')
    ->name('products.index');

/**
 * CartItem
 */
Route::get('user-cart/{user?}', 'Cart\CartController@index')->name('carts.index');
Route::post('user-cart/products/{product}', 'Cart\CartController@store')->name('carts.store');
Route::patch('user-cart/products/{product}', 'Cart\CartController@update')->name('carts.update');
Route::delete('user-cart/products/{product}', 'Cart\CartController@destroy')->name('carts.destroy');
Route::delete('user-cart', 'Cart\CartController@empty')->name('carts.empty');

/**
 * Checkout
 */
Route::get('user-checkout/{user?}','Checkout\CheckoutController@index')
    ->name('checkouts.index');
Route::post('user-checkout/{user?}','Checkout\CheckoutController@store')
    ->name('checkouts.store');
Route::get('checkout/payment/success','Checkout\CheckoutSuccessController')
    ->name('checkouts.success');
Route::get('checkout/payment/error','Checkout\CheckoutErrorController')
    ->name('checkouts.error');
