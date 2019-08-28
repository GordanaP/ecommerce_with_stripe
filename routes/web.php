<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/{user?}', 'TestController@index')->name('test.index');
Route::post('/test/{user?}', 'TestController@store')->name('test.store');
Route::get('test/selected-shipping/{user}/{shipping?}', 'TestController@show')
    ->name('test.show.shippings');


Auth::routes();

Route::get('/home/{user}', 'HomeController@index')->name('home');

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
Route::get('checkout/users/select-shipping-address/{user}/{shipping?}',
    'Checkout\CheckoutUserShippingController@index')
    ->name('checkout.users.shippings.index');

/**
 * UserShipping
 */
Route::patch('users-shippings/{user}/{shipping?}', 'User\UserShippingController@update')
    ->name('users.shippings.update');
Route::get('users/{user}/select-shipping-address',  'User\UserShippingController@index')
    ->name('users.select.shipping');
Route::resource('users.shippings', 'User\UserShippingController', [
    'only' => ['index', 'create', 'store']
]);
