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
     * @return [type] [description]
     *
     * @Route("/{year:[0-9]+}/{month:[0-9]+}", methods={"GET"} )
     */
    public function getPaymentReportData()
    {

    }
}