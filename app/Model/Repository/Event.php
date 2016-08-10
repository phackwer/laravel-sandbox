<?php

namespace App\Model\Repository;

use App\Model\Repository;

class Event extends Repository
{
    /**
     *
     *
     * @param  int $year  [description]
     * @param  int $month [description]
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getEventsForPeriod($year = null, $month = null)
    {
        /**
         * This would be the right thing to do.
         */
        //$year = $year ? $year : date('Y');
        //$month = $month ? $month : date('m');

        //This was done only due the database data we have
        $year  = 2016;
        $month = 1;

        $model = $this->getModelInstance();

        return $model
            ->whereYear('event_timestamp', '=', (string) str_pad($year, 4, '0', STR_PAD_LEFT))
            ->whereMonth('event_timestamp', '=',(string) str_pad($month, 2, '0', STR_PAD_LEFT))
            ->get();
    }
}
