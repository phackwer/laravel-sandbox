<?php

namespace App\Model\BusinessServiceProvider;

use App\Model\ModelBusinessServiceProvider;

/**
 * BusinessServiceProviders should have only specific rules. All the common
 * stuff is handle by a generic Rest Business Service.
 */
class Event extends ModelBusinessServiceProvider
{
    /**
     *
     * @param  int $year  [description]
     * @param  int $month [description]
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getEventsForPeriod($year = null, $month = null)
    {
        return $this->getRepository()->getEventsForPeriod($year, $month);
    }

    public function calculateEventPayDay($date)
    {
        /**
         * rules
         * 1 - Partners are getting paid 4 days after their payment period. If by any chance
         *     the payment date is a weekend, then they are getting paid the first Wednesday
         *     after that.
         * 2 - Payment Intervals:
         *     * Weekly payments intervals: (1 - 7, 8 - 15, 16 - 23, 24 - End of the month)
         *     * Bi-Weekly payments intervals: (1 - 15, 16 - End of the month) 
         *     * Monthly payments intervals: (1 - End of the month) 
         */
    }
}
