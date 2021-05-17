<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'ProductController@index')->name('catalog');
Route::get('buy/{id}', 'ShoppingCarController@add')->name('buy');

Route::get('order/list', 'OrderController@index')->name('order.index');
Route::get('order/create', 'OrderController@create')->name('order.create');
Route::post('order/resume', 'OrderController@resume')->name('order.resume');
Route::get('order/response', 'OrderController@response')->name('order.response');
Route::get('order/{id}', 'OrderController@show')->name('order.show');
Route::post('order/payAgain', 'OrderController@payAgain')->name('order.pay.again');
Route::post('order/pay', 'OrderController@store')->name('order.store');