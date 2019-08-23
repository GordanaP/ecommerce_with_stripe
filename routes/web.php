<?php

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
