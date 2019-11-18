<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        //wallet_number = number. We dont want to duplicate object name inside: there are 2 ways I prefer short because 
        //if in future we will refactor/rename class we dont need to rename column to be LOGICAL
        'user_id', 'currency_id', 'number',
    ];
}
