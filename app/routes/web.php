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

Route::get('/', 'ShopController@index');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/myCart', 'ShopController@myCart');
    Route::post('/myCart', 'ShopController@post');
    Route::post('/deleteCart', 'ShopController@deleteCart');
    Route::post('/checkout', 'ShopController@checkout');
});

Auth::routes();

