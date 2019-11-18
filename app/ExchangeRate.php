<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'currency_id', 'rate', 'default',
    ];
}
