<?php

namespace App\Services;

use App\Exceptions\InsufficientBalanceException;
use App\Helpers\CurrencyConvertHelper;
use App\Transaction;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransferService
{
    public function transfer($transactionId, Carbon $dateTime)
    {
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
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
