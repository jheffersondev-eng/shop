<?php

namespace App\Modules\Home;

use App\Http\Controllers\Login\HomeController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class HomeModule extends Module
{
    public function register(Application $app): void
    {
    }

    public function boot(): void 
    {
    }

    public function getRoutesWeb(): RouteModule
    {
        return new RouteModule("", function () {
            Route::get('/about', [HomeController::class, 'about'])->name('about');
        });
    }

    public function getRoutesApi()
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb(): ActionModule
    {    
        return new ActionModule('Login', []);
    }
}
