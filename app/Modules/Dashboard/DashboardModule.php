<?php

namespace App\Modules\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class DashboardModule extends Module
{
    public function register(Application $app)
    {
    }

    public function boot()  
    {
    }

    public function getRoutesWeb()
    {
        return new RouteModule("dashboard", function () {
            Route::get('/', [DashboardController::class, 'Index'])->name('dashboard');
        });
    }

    public function getRoutesApi()
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb()
    {
    }
}