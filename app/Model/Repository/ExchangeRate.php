<?php

namespace App\Model\Repository;

use App\Model\Repository;

class ExchangeRate extends Repository
{
    /**
     * Get from the database the exchange rate for a currency to GBP
     *
     * @param  [type] $rateDate [description]
     * @param  [type] $currency [description]
     * @return [type]           [description]
     */
    public function getExchangeRate($rateDate, $currency)
    {
        return 1;
    }
}