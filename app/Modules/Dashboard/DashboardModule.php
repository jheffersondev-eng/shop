<?php

namespace App\Modules\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class DashboardModule extends Module
{
    public const NAME = "Dashboard";
    public const ICON = "fa fa-dashboard";

    public function register(Application $app)
    {
    }

    public function boot()  
    {
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getIcon(): string
    {
        return self::ICON;
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