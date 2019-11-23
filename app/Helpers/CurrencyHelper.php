<?php

namespace App\Helpers;


class CurrencyHelper
{
    /**
     * fromRate, toRate should have the same BASE CURRENCY.
     *
     * @param $amount
     * @param $fromRate
     * @param $toRate
     * @param int $scale
     * @return float
     */
    public static function convert($amount, $fromRate, $toRate, $scale = 4) {
        //unified way if you pass even the same currency: 1106.34534534535 we will trim to 1106.3453
        //if I will not use the same function maybe MySQL will round in his way, WE DONT WANT THIS
        return $fromRate == $toRate ?
                (float)bcdiv($amount * 1, 1, $scale)
                : (float)bcdiv($amount * $toRate, $fromRate, $scale);
    }
}
