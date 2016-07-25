<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');
Route::any('/cart/add/{product}/{qty?}', ['as' => 'cart.add', 'uses' => 'CartController@add']);
Route::any('/cart', ['as' => 'cart', 'uses' => 'CartController@index']);
Route::get('/cart/empty', ['as' => 'cart.empty', 'uses' => 'CartController@empty']);
Route::get('/checkout', ['as' => 'checkout', 'uses' => 'CheckoutController@checkout']);
Route::get('/checkout/deletecc', ['as' => 'checkout.deletecc', 'uses' => 'CheckoutController@deletecc']);
Route::get('/checkout/authorize', ['as' => 'checkout.authorize', 'uses' => 'CheckoutController@authorizeOneClick']);
Route::get('/checkout/process', ['as' => 'checkout.process', 'uses' => 'CheckoutController@process']);
Route::get('/checkout/failed', ['as' => 'checkout.failed', 'uses' => 'CheckoutController@failed']);
Route::get('/checkout/thanks', ['as' => 'checkout.thanks', 'uses' => 'CheckoutController@thanks']);
Route::post('/transbank/response', ['as' => 'tbk.oneclick.response', 'uses' => 'CheckoutController@oneclickResponse']);

Route::auth();

Route::get('/home', 'DashboardController@index');
