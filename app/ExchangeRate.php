<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'currency_id', 'rate', 'date', 'default',
    ];

    /**
     * Get the currency that owns the rate.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopeShareLocked($query, $currencyId, Carbon $dateTime, $isDefault = false)
    {
        return $query->whereCurrencyId($currencyId)
            ->where('date', '<=', $dateTime->format('Y-m-d 00:00:00'))
            ->when($isDefault, function ($query) {
                return $query->whereDefault(1);
            })
            ->orderBy('date', 'DESC')
            ->sharedLock();
    }
}
