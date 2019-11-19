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
    Route::resource('clients', 'ClientController');
    Route::resource('users', 'UserController')->middleware('administrator');
});
//https://stackoverflow.com/questions/40223421/api-routes-naming-convention
Route::resource('exchangerates', 'ExchangeRateController');
Route::resource('clients', 'ClientController');
Route::resource('wallets', 'WalletController');
Route::resource('transactions', 'TransactionController');
