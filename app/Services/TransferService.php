<?php

namespace App\Services;

use App\Exceptions\InsufficientBalanceException;
use App\ExchangeRate;
use App\Helpers\CurrencyHelper;
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
            $transaction = Transaction::whereId($transactionId)->lockForUpdate()->firstOrFail();

            //Wallet always exists if transaction exists, but we do extra check as good programming pattern
            $fromWallet = $this->getWalletById($transaction->wallet_id);
            $transferCurrencyRate   = $this->getRateByCurrencyId($transaction->currency_id, $dateTime);
            $fromWalletCurrencyRate = $this->getRateByCurrencyId($fromWallet->currency_id, $dateTime);

            $fromWalletCurrencyAmount = CurrencyHelper::convert(
                $transaction->amount,
                $transferCurrencyRate->rate,
                $fromWalletCurrencyRate->rate
            );

            if ($fromWalletCurrencyAmount > $fromWallet->amount) {
                throw new InsufficientBalanceException(' Insufficient Balance');
            }

            $toWallet =  $this->getWalletById($transaction->to_wallet_id);
            $toWalletCurrencyRate = $this->getRateByCurrencyId($toWallet->currency_id, $dateTime);
            $toWalletCurrencyAmount = CurrencyHelper::convert(
                $transaction->amount,
                $transferCurrencyRate->rate,
                $toWalletCurrencyRate->rate
            );
            $toWallet->amount += $toWalletCurrencyAmount;
            $toWallet->save();

            $fromWallet->amount -= $fromWalletCurrencyAmount;
            $fromWallet->save();

            //UPDATE TRANSACTION
            //Seems logically we can hardcode rate:1 but we follow flexibility in code - if you change in DB it will work here
            $toDefaultCurrencyRate = $this->getRateByCurrencyId($toWallet->currency_id, $dateTime, 1);
            $transferDefaultCurrencyAmount = CurrencyHelper::convert(
                $transaction->amount,
                $transferCurrencyRate->rate,
                $toDefaultCurrencyRate->rate
            );

            $transaction->status = 'executed';
            $transaction->executed_at = $dateTime;
            $transaction->default_currency_amount = $transferDefaultCurrencyAmount;
            $transaction->to_wallet_currency_amount = $toWalletCurrencyAmount;
            $transaction->from_wallet_currency_amount = $fromWalletCurrencyAmount;
            $transaction->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function getWalletById($id)
    {
        return Wallet::whereId($id)
                    ->lockForUpdate()
                    ->firstOrFail();
    }

    /**
     * Gets the rate for currency. Other transaction can read the value but not allowed to UPDATE
     *
     * @param $currencyId
     * @param Carbon $dateTime
     * @param bool $isDefault
     * @return mixed
     */
    private function getRateByCurrencyId($currencyId, Carbon $dateTime, $isDefault = false)
    {
        return ExchangeRate::whereCurrencyId($currencyId)
                    ->where('date', '<=', $dateTime->format('Y-m-d 00:00:00'))
                    ->when($isDefault, function ($query) {
                        return $query->whereDefault(1);
                    })
                    ->orderBy('date', 'DESC')
                    ->sharedLock()
                    ->firstOrFail();
    }
}
