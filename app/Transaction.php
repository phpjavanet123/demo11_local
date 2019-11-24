<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /*
    //Very verbose - not KISS Patten - and not extendable in different ways + we need for events: transaction_details
    protected $fillable = [
        'from_wallet_id', 'to_wallet_id',
        'from_currency_id', 'to_currency_id', 'default_currency_id',
        'from_exchange_currency_rate', 'to_exchange_currency_rate',
        'from_wallet_amount', 'to_wallet_amount',
    ];
    */

    //Aggregate fields
    protected $fillable = [
        'wallet_id', //related to Wallet
        'to_wallet_id',
        'type', //Debit/Credit
        'status',
        'currency_id',
        //'invoice_id', //we dont process for now we are not interder
        //'payment_id', //we dont include as well: VISA, Paxum, Poloniex etc.
        'amount',

        //normany we should keep this data in separate table but because we dont hardcode default USD currency, we need here it to complete report
        //'default_currency_exchange_rate', // we dont keep here because we maybe used +commission, + sheving so it will not be 1:1
        'default_currency_id',
        'default_currency_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'executed_at' => 'datetime',
    ];

    /**
     * Get the wallet that owns the transaction.
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function scopeFromExecuted($query, Carbon $dateTime)
    {
        return $query->where('executed_at', '>=', $dateTime->format('Y-m-d 00:00:00'));
    }

    public function scopeToExecuted($query, Carbon $dateTime)
    {
        return $query->where('executed_at', '<=', $dateTime->format('Y-m-d 00:00:00'));
    }
}
