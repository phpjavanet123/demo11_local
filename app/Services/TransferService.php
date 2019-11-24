<?php

namespace App\Services;

use App\Currency;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\TransferCurrencyException;
use App\Helpers\CurrencyConvertHelper;
use App\Transaction;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransferService
{
    public function createTransaction(Wallet $wallet, Wallet $toWallet, $amount, $transferCurrencyCode, $checkCurrency = true)
    {
        $currency = Currency::whereCode($transferCurrencyCode)->firstOrFail();
        if ($checkCurrency && !in_array($currency->id, [$wallet->id, $toWallet->id])) {
            /*
             * Validation if currency does not belong to Wallet or not in currency of other Wallet.
             * It is also safe for execution time of transaction because we not allow to change currency between
             * creation and execution of transaction
             */
            throw new TransferCurrencyException('Please use your wallet currency or destination Wallet currency');
        }

        return Transaction::create([
            'wallet_id' => $wallet->id,
            'to_wallet_id' => $toWallet->id,
            'type' => 1,
            'status' => 'pending',
            'currency_id' => $currency->id, //TODO::: maybe rename to: transfer_currency_amount
            'amount' => $amount, //TODO::: maybe rename to:  transfer_currency_amount
        ]);
    }

    public function transfer($transactionId, Carbon $dateTime)
    {
        /**
         * Seems it has advantage like Handling Deadlocks: up to 5. But in this example we will use traditional way
         * DB::transaction(function() { }, 5);
         */
        //pessimistic locking
        DB::beginTransaction();
        try {
            $transaction                = Transaction::whereId($transactionId)->lockForUpdate()->firstOrFail();
            $fromWallet                 = Wallet::locked($transaction->wallet_id)->firstOrFail();
            $currencyConvert            = new CurrencyConvertHelper(
                $transaction->amount,
                $transaction->currency_id,
                $dateTime
            );
            $fromWalletCurrencyAmount   = $currencyConvert->convertToCurrency($fromWallet->currency_id);

            if ($fromWalletCurrencyAmount > $fromWallet->amount) {
                throw new InsufficientBalanceException(' Insufficient Balance');
            }

            $toWallet               =  Wallet::locked($transaction->to_wallet_id)->firstOrFail();
            $toWalletCurrencyAmount = $currencyConvert->convertToCurrency($toWallet->currency_id);

            $toWallet->amount       += $toWalletCurrencyAmount;
            $toWallet->save();
            $fromWallet->amount     -= $fromWalletCurrencyAmount;
            $fromWallet->save();

            //UPDATE TRANSACTION
            //Seems logically we can hard-code rate:1 but we follow flexibility in code - if you change in DB it will work here
            $transferDefaultCurrencyAmount = $currencyConvert->convertToCurrency($toWallet->currency_id, true);

            $transaction->status                        = 'executed';
            $transaction->executed_at                   = $dateTime;
            $transaction->default_currency_amount       = $transferDefaultCurrencyAmount;
            $transaction->to_wallet_currency_amount     = $toWalletCurrencyAmount;
            $transaction->from_wallet_currency_amount   = $fromWalletCurrencyAmount;
            $transaction->save();

            DB::commit();

            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
