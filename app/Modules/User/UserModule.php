<?php

namespace App\Modules\User;

use App\Http\Controllers\User\UserController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class UserModule extends Module
{
    public const NAME = "User";
    public const ICON = "fa fa-user";

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
        return new RouteModule("user", function () {
            Route::get('/', [UserController::class, 'Index'])->name('user.index');
            Route::get('/{user}/edit', [UserController::class, 'Edit'])->name('user.edit');
            Route::put('/{user}', [UserController::class, 'Update'])->name('user.update');
            Route::delete('/{user}', [UserController::class, 'Destroy'])->name('user.destroy');
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
        //$permissoes[] = (new PermissionBlockResource("User", UserController::class))->toArray();
        //return new ActionModule(self::NAME, $permissoes);
    }
}
