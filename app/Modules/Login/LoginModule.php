<?php

namespace App\Modules\Login;

use App\Http\Controllers\Login\LoginController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class LoginModule extends Module
{
    public const NAME = "Login";
    public const ICON = "fa fa-user";

    public function register(Application $app)
    {

    }

    public function getRoutesWeb()
    {
        return new RouteModule("login", function () {
            Route::resource('/login', LoginController::class)->only('index');
        });
    }

    public function boot()
    {
    }

    public function getRoutesApi()
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb()
    {
        //$permissoes[] = (new PermissionBlockResource("Login", LoginController::class))->toArray();
        //return new ActionModule(self::NAME, $permissoes);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getIcon(): string
    {
        return self::ICON;
    }
}
