<?php

namespace App\Model\Repository;

use App\Model\Entity\Currency;
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
        if ($currency == Currency::GBP) {
            return 1;
        }

        return $this
            ->getModelInstance()
            ->where('currency_id', '=', $currency)
            ->whereDate('rate_start_date', '<=', $rateDate)
            ->whereDate('rate_end_date', '>=', $rateDate)
            ->get()[0]['rate_value'];
    }
}
