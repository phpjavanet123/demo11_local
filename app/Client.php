<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = [
    'name',
    'surname',
    'date_of_birth',
	'email',
	'password',
	'phone_number',
	'address',
	'country',
	'trading_account_number',
	'balance',
	'open_trades',
	'close_trades',
  ];
}
