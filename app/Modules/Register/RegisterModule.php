<?php

namespace App\Modules\Register;

use App\Http\Controllers\Register\RegisterController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class RegisterModule extends Module
{
    public function register(Application $app): void
    {
    }

    public function boot(): void
    {
    }

    public function getRoutesWeb(): RouteModule
    {
        return new RouteModule("register", function () {
            Route::get('/create', [RegisterController::class, 'signUp'])->name('register.create');
            Route::post('/', [RegisterController::class, 'register'])->name('register.store');
            Route::get('/verify-email', [RegisterController::class, 'verifyEmailView'])->name('register.verify-email-view');
            Route::post('/verify-email', [RegisterController::class, 'verifyEmail'])->name('register.verify-email');
        });
    }

    public function getRoutesApi()//: RouteApiModule
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb(): ActionModule
    {    
        return new ActionModule('Register', []);
    }
}
