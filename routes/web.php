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
Route::get('carts/{user?}', 'Cart\CartController@index')->name('carts.index');
Route::delete('carts', 'Cart\CartController@empty')->name('carts.empty');
Route::post('carts/{product}', 'Cart\CartController@store')->name('carts.store');
Route::patch('carts/{product}', 'Cart\CartController@update')->name('carts.update');
Route::delete('carts/{product}', 'Cart\CartController@destroy')->name('carts.destroy');
