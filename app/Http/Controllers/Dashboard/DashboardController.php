<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use App\Services\Dashboard\IDashboardService;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    protected IDashboardService $dashboardService;

    public function __construct(IDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $statistics = $this->dashboardService->getStatistics();

        return view('dashboard.index')->with('statistics', $statistics);
    }
}