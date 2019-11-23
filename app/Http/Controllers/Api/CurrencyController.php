<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Exception;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $currencies = [
            'base_currency' => Currency::whereDefault('1')->firstOrFail()->code,
            'timestamp'     => Carbon::now()->toDateTimeString(),
            'currencies'    => Currency::all()
        ];
         return response()->json($currencies);
        */
        return response()->json(Currency::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Usually our micro-service should be very flexible, dynamically add or remove currencies should not be problem
        //but it is only allowed for account who has required role. For now we skip it - as DEMO
        throw new Exception('Not implemented');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //default laravel REST API mapping will work as http://demo11.local/api/currencies/2
        //but it is not convenient for US, we want to show how to operate with ISO codes name
        //because another micro-service does not know our ID (or make 2 calls, latency become bigger, some errors during requests...),
        // or it is not convenient, so we use ISO codes
        //as exchange between another micro-services or even better EXTERNAL micro-service it is very convenient

        return response()->json($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
