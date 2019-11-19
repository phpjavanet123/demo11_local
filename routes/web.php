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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('clients2', 'ClientController');
    Route::resource('users', 'UserController')->middleware('administrator');
});

//https://www.reddit.com/r/laravel/comments/bx92cc/difference_between_routeapiresource_and/

//https://stackoverflow.com/questions/40223421/api-routes-naming-convention
//Route::resource('exchangerates', 'ExchangeRateController');
//Route::resource('clients', 'ClientController');
//Route::resource('wallets', 'WalletController');
//Route::resource('transactions', 'TransactionController');

Route::apiResource('exchangerates', 'ExchangeRateController');
Route::apiResource('clients', 'ClientController');
Route::apiResource('wallets', 'WalletController');
Route::apiResource('transactions', 'TransactionController');


//http://demo11.local/api/users
Route::apiResource('api/users', 'Api\UserController');
