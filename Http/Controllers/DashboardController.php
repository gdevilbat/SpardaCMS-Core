<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;

class DashboardController extends CoreController
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index()
    {
        return view('core::dashboard');
    }
}
