<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Services\TransferService;
use App\Transaction;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{
    protected $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Wallet $wallet)
    {
        throw new \Exception('Not implemented!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Wallet $wallet)
    {
        //TODO::: Add validation for Request to be sure we have all required params
        $transaction = $this->transferService->createTransaction(
            $wallet,
            User::whereName('Withdraw')->firstOrFail()->wallet()->firstOrFail(),
            $request->get('amount'),
            $request->get('currency_code'),
            false
        );

        return response()->json([
            'transaction_id' => $transaction->id,
            'status' => $transaction->status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        throw new \Exception('Not implemented!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //TODO::: add check that transaction TYPE is WITHDRAW
        if ($request->get('status') == 'execute') {
            $transaction = $this->transferService->transfer($transaction->id, Carbon::now());
            return response()->json([
                'transaction_id' => $transaction->id,
                'status' => $transaction->status,
            ]);
        }
        //rest $request->get('status') == 'XXX' not implemented
        throw new \Exception('Not implemented!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        throw new \Exception('Not implemented!');
    }
}
