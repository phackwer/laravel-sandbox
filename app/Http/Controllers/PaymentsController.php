<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Controllers are for routes and API only. All specific rules are on the
 * App\Model\BusinessServiceProvider layer.
 *
 * Check RestApiController for details on this controller behaviour
 */
class PaymentsController extends ServiceController
{
    /**
     * Default route to show that the controller is up and running on desired path
     *
     * @Route("/{year:[0-9]+}/{month:[0-9]+}", methods={"GET"} )
     */
    public function show()
    {
        $data = $this->getService()->getPaymentReportData();
        return response()->json($data);
    }
}
