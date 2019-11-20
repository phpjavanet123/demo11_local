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

use App\Transaction;
use App\Wallet;

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

Route::model('wallet', Wallet::class);
//Route::model('transaction', Transaction::class);
Route::model('transfer', Transaction::class);

//Route::model('wallet', 'Wallet');
//Route::model('transaction', 'Transaction');

//Route::get('api/wallets/{wallet}/transfers', 'Api\WalletTransferController@index');
//Route::get('api/wallets/{wallet}/transfers/{transaction}', 'Api\WalletTransferController@show');

//Route::apiResource('api/wallets', 'Api\WalletController');
//Route::apiResource('api/wallets/{wallet}/transfers', 'Api\WalletTransferController');
//Route::resource('api/wallets.transfers', 'Api\WalletTransferController');

//http://demo11.local/api/wallets/1/transfers/2
//Route::apiResource('api/wallets/{wallet}/transfers/{transaction}', 'Api\WalletTransferController');

//http://demo11.local/api/wallets/1/transfers
//Route::apiResource('api/wallets.transfers', 'Api\WalletTransferController');
Route::apiResource('api/wallets.transfers', 'Api\WalletTransferController');
//Route::apiResource('api/wallets/{wallet}/transfers/{transaction}', 'Api\WalletTransferController');
/*
Envy@DESKTOP-D3CG9B9 MINGW64 /e/xampp/htdocs/demo11.local (master)
$ php artisan route:list
    +--------+-----------+-------------------------------------------+---------------------------+------------------------------------------------------------------------+------------------------+
| Domain | Method    | URI                                       | Name                      | Action                                                                 | Middleware             |
+--------+-----------+-------------------------------------------+---------------------------+------------------------------------------------------------------------+------------------------+
|        | GET|HEAD  | /                                         |                           | Closure                                                                | web                    |
|        | GET|HEAD  | api/user                                  |                           | Closure                                                                | api,auth:api           |
|        | POST      | api/users                                 | users.store               | App\Http\Controllers\Api\UserController@store                          | web                    |
|        | GET|HEAD  | api/users                                 | users.index               | App\Http\Controllers\Api\UserController@index                          | web                    |
|        | DELETE    | api/users/{user}                          | users.destroy             | App\Http\Controllers\Api\UserController@destroy                        | web                    |
|        | PUT|PATCH | api/users/{user}                          | users.update              | App\Http\Controllers\Api\UserController@update                         | web                    |
|        | GET|HEAD  | api/users/{user}                          | users.show                | App\Http\Controllers\Api\UserController@show                           | web                    |
|        | POST      | api/wallets/{wallet}/transfers            | wallets.transfers.store   | App\Http\Controllers\Api\WalletTransferController@store                | web                    |
|        | GET|HEAD  | api/wallets/{wallet}/transfers            | wallets.transfers.index   | App\Http\Controllers\Api\WalletTransferController@index                | web                    |
|        | PUT|PATCH | api/wallets/{wallet}/transfers/{transfer} | wallets.transfers.update  | App\Http\Controllers\Api\WalletTransferController@update               | web                    |
|        | GET|HEAD  | api/wallets/{wallet}/transfers/{transfer} | wallets.transfers.show    | App\Http\Controllers\Api\WalletTransferController@show                 | web                    |

*/
