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
         */
    }
}
