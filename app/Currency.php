<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'code', 'symbol',
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * Get the rate record associated with the currency.
     */
    public function rate()
    {
        return $this->hasOne(ExchangeRate::class);
    }
}
