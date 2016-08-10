<?php

namespace App\Model\BusinessServiceProvider;

use App\Model\ModelBusinessServiceProvider;
use App\Model\Entity\Currency;

/**
 * BusinessServiceProviders should have only specific rules. All the common
 * stuff is handle by a generic Rest Business Service.
 */
class ExchangeRate extends ModelBusinessServiceProvider
{
    /**
     * Convert a value from a given currency to EUR on a specific date
     *
     * Rates source:
     * https://www.gov.uk/government/publications/hmrc-exchange-rates-for-2016-monthly
     *
     * Since source are rates to GBP, first, convert to GBP and them to EUR
     *
     * @param  [type] $rateDate     [description]
     * @param  [type] $valueFrom    [description]
     * @param  string $currencyFrom [description]
     * @param  string $currencyTo   [description]
     * @return [type]               [description]
     */
    public function getConvertedValue($rateDate, $valueFrom, $currencyFrom)
    {
        /**
         * Rate for given currency
         * @var [type]
         */
        $origRate = $this->getExchangeRate($rateDate, $currencyFrom);
        $gbpOrigVal = ($valueFrom / $origRate);

        /**
         * Rate for euro
         * @var [type]
         */
        $euroRate = $this->getExchangeRate($rateDate, Currency::EUR);

        /**
         * Simple Conversion
         */
        return ($euroRate * $gbpOrigVal);
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
