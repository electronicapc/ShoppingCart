<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','ShopController@index');

Route::get('/categoria/{id}/{asc?}', 'ShopController@show')->where(['id' => '[0-9]+'],['asc' => '[a-zA-Z]+']);

Route::get('/categoria/single/{id}', 'ShopController@showprod')->where(['id' => '[0-9]+']);

Route::post('/checkout', 'CheckoutController@addprod');
Route::get('/checkout', function () {
    return view('cart');
});
Route::post('/checkout/{id}/{can}', 'CheckoutController@addcant')->where(['can' => '[0-9]+'],['id' => '[0-9]+']);
Route::get('/checkout/{id}', 'CheckoutController@remcant')->where(['id' => '[0-9]+']);

Route::get('/vrfauth', 'ShopController@showprod')->where(['id' => '[0-9]+']);

Auth::routes();

Route::get('/pruebas', function () {
	return view('pruebas');
});

Route::get('/logout', function () {
    Auth::logout();
    return back();
    
});