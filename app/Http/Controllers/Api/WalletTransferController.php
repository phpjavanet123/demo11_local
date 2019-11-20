<?php

namespace App\Http\Controllers\Api;

use App\Transaction;
use App\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index(Wallet $wallet, Transaction $transaction)
    public function index()
    {
        //print_r($wallet->toArray());
        //print_r($transaction->toArray());
        die('2222');
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
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet, Transaction $transaction)
    //public function show(Request $request)
    {
        //https://stackoverflow.com/questions/29255803/correct-way-of-nesting-dynamic-resource-controllers-with-laravel-when-creating-a
        //print_r($request->all());
        print_r($wallet->toArray());
        print_r($transaction->toArray());
        die('33333');
    }

    public function show3($id1, $id2)
        //public function show(Request $request)
    {
        //print_r($request->all());
        print_r($id1);
        echo '<br />';
        print_r($id2);
        echo '<br />';
        die('4444');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
