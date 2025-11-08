<?php

namespace App\Modules\Register;

use App\Http\Controllers\Register\RegisterController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class RegisterModule extends Module
{
    public const NAME = "Register";
    public const ICON = "fa fa-user-plus";

    public function register(Application $app): void
    {
    }

    public function boot(): void
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

    public function getRoutesWeb(): RouteModule
    {
        return new RouteModule("register", function () {
            Route::get('/', [RegisterController::class, 'SignUp'])->name('register');
            Route::post('/', [RegisterController::class, 'Register'])->name('register.post');
        });
    }

    public function getRoutesApi()//: RouteApiModule
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb()//: ActionModule
    {
        //$permissoes[] = (new PermissionBlockResource("Login", LoginController::class))->toArray();
        //return new ActionModule(self::NAME, $permissoes);
    }
}
