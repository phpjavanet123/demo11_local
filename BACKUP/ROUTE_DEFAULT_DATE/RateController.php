<?php

namespace App\Http\Controllers\Api\Currency;

use App\Currency;
use App\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Currency $currency, ExchangeRate $rate, $date)
    {
        //Why we do it here
        echo $date, "<br />";
        die('18881');
        return response()->json($currency);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency, ExchangeRate $rate)
    {
        print_r($request->all());
        $timestamp = $request->get('timestamp');
        //2019-11-23 10:22:44
        $date = is_numeric($timestamp) ? Carbon::createFromTimestamp($timestamp) : new Carbon($timestamp);
        print_r($date->format('Y-m-d H:i:s'));
        print_r($currency->toArray());
        print_r($rate->toArray());
        die('111');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeRate $exchangeRate)
    {
        //
    }
}
