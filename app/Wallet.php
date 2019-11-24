<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        //wallet_number = number. We dont want to duplicate object name inside: there are 2 ways I prefer short because
        //if in future we will refactor/rename class we dont need to rename column to be LOGICAL
        'user_id', 'currency_id', 'number', 'amount',
    ];

    /**
     * Get the user that owns the wallet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transaction record associated with the wallet.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactionsTo()
    {
        return $this->hasMany(Transaction::class, 'to_wallet_id');
    }

    /**
     * Merges from Wallet transactions and to Wallet transactions.
     * @note: we use this method for reports, as quick solution without extra tables or duplicates row in transaction
     * to associate wallets with transactions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function transactionsFromTo(Carbon $dateTimeFrom = null, Carbon $dateTimeTo = null)
    {
        $fromWallet = $this->appendExecutedAtWhere($this->transactions(), $dateTimeFrom, $dateTimeTo)->get();
        $toWallet   = $this->appendExecutedAtWhere($this->transactionsTo(), $dateTimeFrom, $dateTimeTo)->get();

        return $fromWallet->merge($toWallet)->sortByDesc('executed_at');
    }

    public function scopeLocked($query, $id)
    {
        return $query->whereId($id)->lockForUpdate();
    }

    private function appendExecutedAtWhere($query, $dateTimeFrom, $dateTimeTo)
    {
        return $query->when($dateTimeFrom, function ($query) use ($dateTimeFrom) {
            return $query->fromExecuted($dateTimeFrom);
        })
        ->when($dateTimeTo, function ($query) use ($dateTimeTo) {
            return $query->toExecuted($dateTimeTo);
        });
    }
}
