<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller {

    public function __construct(
            protected \App\Services\StatisticService $service
    )
    {

    }

    public function getAll(Request $request)
    {
        return response()->json($this->service->getAll());
    }
}
