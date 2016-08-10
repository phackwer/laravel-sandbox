<?php

namespace App\Model\BusinessServiceProvider;

use App\Model\ModelBusinessServiceProvider;

/**
 * BusinessServiceProviders should have only specific rules. All the common
 * stuff is handle by a generic Rest Business Service.
 */
class ExchangeRate extends ModelBusinessServiceProvider
{
    /**
     * Convert a value from a given currency to GBP on a specific date
     *
     * @param  [type] $rateDate     [description]
     * @param  [type] $valueFrom    [description]
     * @param  string $currencyFrom [description]
     * @param  string $currencyTo   [description]
     * @return [type]               [description]
     */
    public function getConvertedValue($rateDate, $valueFrom, $currencyFrom)
    {
        $rate = $this->getExchangeRate($rateDate, $currencyFrom);
        return ($valueFrom * $rate);
    }

    /**
     * Get from the database the exchange rate for a currency to GBP
     *
     * @param  [type] $rateDate [description]
     * @param  [type] $currency [description]
     * @return [type]           [description]
     */
    public function getExchangeRate($rateDate, $currency)
    {
        return $this->getRepository()->getExchangeRate($rateDate, $currency);
    }
}
