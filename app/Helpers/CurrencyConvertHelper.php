<?php

namespace App\Helpers;


use App\ExchangeRate;
use Carbon\Carbon;

class CurrencyConvertHelper
{
    private $amount;
    private $fromRate;
    private $dateTime;
    private $scale;

    public function __construct($amount, $currencyId, Carbon $dateTime, $scale = 4)
    {
        $this->amount       = $amount;
        $this->dateTime     = $dateTime;
        $this->scale        = $scale;
        $this->fromRate     = $this->getRate($currencyId, $dateTime);
    }

    /**
     * Gets the rate for currency. Other transaction can read the value but not allowed to UPDATE
     *
     * @param $currencyId
     * @param Carbon $dateTime
     * @param bool $isDefault
     * @return mixed
     */
    private function getRate($currencyId, Carbon $dateTime, $isDefault = false)
    {
        return ExchangeRate::shareLocked($currencyId, $dateTime, $isDefault)->firstOrFail()->rate;
    }

    public function convertToCurrency($currencyId, $isDefault = false) {
        return $this->convert($this->getRate($currencyId, $this->dateTime));
    }

    /**
     * fromRate, toRate should have the same BASE CURRENCY.
     *
     * @param $toRate
     * @return float
     */
    private function convert($toRate) {
        //unified way if you pass even the same currency: 1106.34534534535 we will trim to 1106.3453
        //if I will not use the same function maybe MySQL will round in his way, WE DONT WANT THIS
        return $this->fromRate == $toRate ?
                (float)bcdiv($this->amount * 1, 1, $this->scale)
                : (float)bcdiv($this->amount * $toRate, $this->fromRate, $this->scale);
    }
}
