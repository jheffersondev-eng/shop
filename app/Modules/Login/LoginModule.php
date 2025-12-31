<?php

namespace App\Modules\Login;

use App\Http\Controllers\Login\LoginController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class LoginModule extends Module
{
    public function register(Application $app): void
    {
    }

    public function boot(): void 
    {
    }

    public function getRoutesWeb(): RouteModule
    {
        return new RouteModule("login", function () {
            Route::get('/', [LoginController::class, 'Index'])->name('login');
            Route::post('/', [LoginController::class, 'Login'])->name('login.post');
            Route::post('/logout', [LoginController::class, 'Logout'])->name('logout');
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
