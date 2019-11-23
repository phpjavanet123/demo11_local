<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'currency_id', 'rate', 'default',
    ];

    /**
     * Get the currency that owns the rate.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
