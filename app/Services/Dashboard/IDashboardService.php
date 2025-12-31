<?php

namespace App\Services\Dashboard;

use App\Http\Dto\Dashboard\StatisticDto;

interface IDashboardService
{
    public function getStatistics(): StatisticDto;
}