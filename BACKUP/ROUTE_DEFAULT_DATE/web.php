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
use Illuminate\Support\Facades\Route;
//for IDE PhpStorm
use Illuminate\Routing\Route as RouteBind;

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

//WE dont support rest operation for now: , ['except' => ['index', 'show']]
//Route::apiResource('api/currencies', 'Api\CurrencyController', ['only' => ['index', 'show']]);
//Route::apiResource('api/currencies', 'Api\CurrencyController', ['except' => ['index', 'show']]);

/**
 * We could use like this, but we will place it in Model because we will use always one style, and will not manipulate with it
 * @see: https://laravel.com/docs/5.8/routing#route-model-binding
 * @details: php Documentor uses the github variant of markdown
 * ```php
 * Route::bind('currency', function ($value) {
 * return App\Currency::where('code', $value)->first() ?? abort(404);
 * });
 * Route::apiResource('api/currencies', 'Api\CurrencyController');
 * ```
 */
//Route::apiResource('api/currencies', 'Api\CurrencyController');

//Here we cannot use: getRouteKeyName() on model because we use complicated query
//https://laravel.io/forum/10-13-2015-how-to-get-http-request-in-route-model-binding-closure
Route::bind('rate', function ($rate,  RouteBind $route)  {
    $s = 1;
    $d2 = $route->parameter('date');
    $d12 =2;
    //$request = $router->getCurrentRequest();
    //print_r($rate);
    //print_r($date);
    //die();
    //$el =  App\Currency::where('code', $rate)->firstOrFail()
    //$el =  App\Currency::where('code', $rate)->first();

    //http://demo11.local/api/currencies/USD/rates/EUR1 return 500
    //return App\Currency::where('code', $rate)->first() ?? abort(500);

    //http://demo11.local/api/currencies/USD/rates/EUR1 return 404
    //return App\Currency::where('code', $rate)->firstOrFail() ?? abort(500);

    //Laravel firstOrFail return by default 404  https://laravel-news.com/laravel-firstorfail-forthewin
    //return App\Currency::where('code', $rate)->firstOrFail()->rate()->first() ?? abort(404);

    //By default return 404
    //http://demo11.local/api/currencies/USD/rates/EUR1
    return App\Currency::where('code', $rate)->firstOrFail()->rate()->firstOrFail();
});
//JAVA version SPRINT BOOT https://stackoverflow.com/questions/38032635/pass-multiple-parameters-to-rest-api-spring/38032778
Route::get('api/currencies/{currency}/rates/{rate}/{date?}', [
    'as'       => 'currencies/{currency}/rates/{rate}/{date?}',
    'uses'     => 'Api\Currency\RateController@index',
])->defaults('date', \Carbon\Carbon::now()->getTimestamp());
/*
Route::get('11api/currencies/{currency}/rates/{rate}/{date?}', function ($currency, $rate, $date = '123') {
    //$ctrl = new \App\Http\Controllers\Api\Currency\RateController();
    //$currency = App\Currency::where('code', $currency)->first();
    die('111');
    //return $ctrl->index($currency);
});
*/
Route::apiResource('api/currencies.rates', 'Api\Currency\RateController');
//check new route added and methods & arguments names
//php artisan route:list


/*
//http://demo11.local/api/currencies/rates

//Example 1
//https://medium.com/@SlyFireFox/the-power-of-laravels-route-defaults-for-making-root-level-seo-pages-ae6da1d9fd51
Route::get('/api/currencies/rates', [
    'as'       => 'currencies.rates',
    'uses'     => 'Api\Currency\RateController@index',
])->defaults('currency', App\Currency::where('code', 'USD')->first());

//Example 2
//https://stackoverflow.com/questions/31871910/how-to-pass-default-values-to-controller-by-routing-in-laravel-5
Route::get('/api/currencies/rates', function ($code = 'USD') {
    $ctrl = new \App\Http\Controllers\Api\Currency\RateController();
    $currency = App\Currency::where('code', $code)->first();
    return $ctrl->index($currency);
});

Route::apiResource('api/currencies', 'Api\CurrencyController');
*/
