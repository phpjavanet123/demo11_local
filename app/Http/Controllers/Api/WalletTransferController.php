<?php

namespace App\Http\Controllers\Api;

use App\Services\TransferService;
use App\Transaction;
use App\Wallet;
use App\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CurrencyHelper;

class WalletTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Wallet $wallet)
    {
        //$transactions = $wallet->transactions()->get();
        //$transactions = $wallet->transactionsTo()->get();
        $transactions = $wallet->transactionsFromTo();
        print_r($transactions);
        //print_r($wallet->toArray());
        die('2222');

        $transactions = Transaction::whereWalletId($wallet->id)->get();
        return response()->json($transactions);

        //print_r($wallet->toArray());
        //die('2222');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Wallet $wallet)
    {
        //Get another wallet
        $toWallet = Wallet::whereNumber($request->get('to_wallet_number'))->firstOrFail();
        $transferCurrencyCode = $request->get('currency_code');
        $currency = Currency::whereCode($transferCurrencyCode)->firstOrFail();
        $amount = $request->get('amount');

        if (!in_array($currency->id, [$wallet->id, $toWallet->id])) {
            /*
             * Validation if currency does not belong to Wallet or not in currency of other Wallet.
             * It is also safe for execution time of transactino because we not allow to change currency between
             * creation and execution of transaction
             */
            throw new \Exception('Please use your wallet currency or destination Wallet currency');
        }

        $transaction = Transaction::create([
            'wallet_id' => $wallet->id,
            'to_wallet_id' => $toWallet->id,
            'type' => 1,
            'status' => 'pending',
            'currency_id' => $currency->id, //transfer_currency_amount
            'amount' => $amount, //transfer_currency_amount
        ]);
        //We could use automapper here: https://packagist.org/packages/mark-gerarts/auto-mapper-plus
        //but for test project we will not it, because other goal to show own code
        return response()->json([
            'transaction_id' => $transaction->id,
            'status' => $transaction->status,
        ]);



        die('ttttttttt');
        //Get another wallet
        $toWallet = Wallet::whereNumber($request->get('to_wallet_number'))->firstOrFail();
        //print_r($toWallet->toArray());

        //SELECT * FROM demo11_local.exchange_rates;
        //GET RATES FROM wallet, toWallet Also Rates: latest from today or BEFORE


        //Convert amount to another wallet currency
        //WRITE UTILITY CLASS - convert currency
        $amount = $request->get('amount');
        $toWalletCurrencyAmount = CurrencyHelper::convert($amount, 0.95, 30);
        print_r($toWalletCurrencyAmount);



        die('333');
        $transaction = Transaction::create([
            'wallet_id' => $wallet->id,
            'to_wallet_id' => $toWallet->id,
            'type' => 1,
            'status' => 'created',
            'currency_id' => $wallet->id, //transfer_currency_amount
            'amount' => $amount, //transfer_currency_amount
            //WE CALCULATE CURRENCY RATE On DATE when transaction will be executed, because if it is 10 days after course can be different
            //IN UPDATE we also add values to COLUMNS BELOW
            //THIS METHOD WE JUST CREATE TRANSACTION
            'from_wallet_currency_amount' => $toWalletCurrencyAmount, //if user sends not in his wallet currency we convert here
            'to_wallet_currency_amount' => $toWalletCurrencyAmount, //if destination in another currency
            'default_currency_amount' => CurrencyHelper::convert($amount, 0.95, 1),
            'executed_at', // date when transaction was executed
        ]);

        //Save transaction with type + status

        //return transaction_ID back to user, and status

        die('<br />334');
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
    public function update(Request $request, Wallet $wallet, Transaction $transaction)
    {
        //check if transaction belong to wallet
        //check if status == pending (after create ENUM of statuses)
        if ($transaction->status != 'pending') {
            //Or we can ignore it, and say only it was exucuted and return date -> all array of transaction
            //amount took from, putted amount ON, substract from account and add to wallet another account
            throw new \Exception('Transaction already was executed');
        }

        //print_r($request->all());
        //WE PASS "status" => "execute" OR: "status" => "rollback"
        if ($request->get('status') == 'execute') {
            //die('111');
            (new TransferService())->transfer($transaction->id, Carbon::now());
        }


        //we actually will execute HERE TRANSACTION
        //https://stackoverflow.com/questions/147207/transactions-in-rest

        print_r($wallet->toArray());
        print_r($transaction->toArray());
        die('33333');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        throw new \Exception('Not implemented!');
    }
}
