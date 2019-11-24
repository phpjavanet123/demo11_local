<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //echo '<pre>';
        //$id = Auth::user()->id;
        $fromDate = $request->get('date_from', null);
        $toDate = $request->get('to_from', null);
        $fromDate = $fromDate ? new Carbon($fromDate) : null;
        $toDate = $toDate ? new Carbon($toDate) : null;

        $userID = $request->get('user_id', null);
        $user = $userID ? User::findOrFail($userID) : Auth::user();
        //$transactions = Auth::user()->wallet()->firstOrFail()->transactionsFromTo(new Carbon('2019-11-24'));
        $transactions = $user->wallet()->firstOrFail()->transactionsFromTo($fromDate, $toDate);
        $transactionsSum = $transactions->sum('from_wallet_currency_amount');
        $transactionsDefaultSum = $transactions->sum('default_currency_amount');

        //SOT BY ID, and restrict by filter
        //print_r($transactions->toArray());
        $users = User::all();
        return view('transactions.index', compact(
            'users',
            'transactions',
            'transactionsSum',
            'transactionsDefaultSum'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
