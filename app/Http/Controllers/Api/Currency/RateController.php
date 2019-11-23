<?php

namespace App\Http\Controllers\Api\Currency;

use App\Currency;
use App\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Currency $currency, ExchangeRate $rate)
    {
        //Why we do it here
        //echo $date, "<br />";
        die('18881');
        return response()->json($currency);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Currency $currency)
    {
        $dateTime = $request->get('timestamp');
        $date = is_numeric($dateTime) ? Carbon::createFromTimestamp($dateTime) : new Carbon($dateTime);

        $existRecord = ExchangeRate::where('currency_id', $currency->id)
                        ->where('date', $date->format('Y-m-d 00:00:00'))->first();
        //good style to check, suggest we dont have unique key on MySQL or it is very generic validation logic
        //later we can more to requestForm validation like we did in ClientRequest of UserController
        if ($existRecord) {
            throw new \Exception('Already exists!');
        }
        //but we also add Unique KEY on MYSQL to prevent concurrency
        $rate = ExchangeRate::create([
            'currency_id' => $currency->id,
            'rate' => $request->get('rate'),
            'date' => $date->format('Y-m-d 00:00:00'),
        ]);
        print_r($rate->toArray());
        die('18881');





        print_r($request->all());
        print_r($currency->toArray());
        //print_r($rate->toArray());
        die('18881');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency, ExchangeRate $rate)
    {
        //http://demo11.local/api/currencies/EUR/rates/2019-11-24
        print_r($currency->toArray());
        print_r($rate->toArray());
        die('18881');
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
        $rate->rate = $request->get('rate');
        $rate->save();
        return response()->json($rate);


        /*
        print_r($rate->toArray());


        die();
        $timestamp = $request->get('timestamp');
        //2019-11-23 10:22:44
        $date = is_numeric($timestamp) ? Carbon::createFromTimestamp($timestamp) : new Carbon($timestamp);
        print_r($date->format('Y-m-d H:i:s'));
        print_r($currency->toArray());
        print_r($rate->toArray());
        die('111');
        */
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
