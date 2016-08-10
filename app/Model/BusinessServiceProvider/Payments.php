<?php

namespace App\Model\BusinessServiceProvider;

use App\Model\BusinessServiceProvider;

/**
 * BusinessServiceProviders should have only specific rules. All the common
 * stuff is handle by a generic Rest Business Service.
 */
class Payments extends BusinessServiceProvider
{
    /**
     * [getPaymentReportData description]
     * @return array [description]
     */
    public function getPaymentReportData($year = null, $month = null)
    {
        /**
         * Report Data
         * @var array
         */
        $data = [];

        /**
         * Services used for this
         */
        /** @var Event Events service */
        $exchangeSrv = new ExchangeRate($this->app);
        /** @var Event Events service */
        $eventSrv = new Event($this->app);

        /**
         * Events that will be processed
         * @var array
         */
        $events = $eventSrv->getEventsForPeriod($year, $month);

        foreach ($events as $k => $event) {
            $payDay   = $eventSrv->calculateEventPayDay($event['event_timestamp']);
            $payValue = $exchangeSrv->getConvertedValue($event['event_timestamp'], $event['event_value'], $event['currency_id']);

            $data[$k] = [
                'Event timestamp'       => $event['event_timestamp'],
                'Partner'               => $event['partner_id'],
                'Possible Pay day'      => $payDay,
                'Converted Value (GBP)' => $payValue,
                'Original Value'        => $payValue,
                'Original Currency'     => $payValue,
            ];
        }

        return $data;
    }
}
