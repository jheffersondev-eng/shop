<?php

namespace App\Modules\User;

use App\Http\Controllers\User\UserController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class UserModule extends Module
{
    public function register(Application $app): void
    {
    }

    public function boot(): void
    {
    }

    public function getRoutesWeb(): RouteModule
    {
        return new RouteModule("user", function () {
            Route::get('/', [UserController::class, 'Index'])->name('user.index');
            Route::get('/create', [UserController::class, 'Create'])->name('user.create');
            Route::post('/create', [UserController::class, 'Store'])->name('user.store');
            Route::get('/{user}/edit', [UserController::class, 'Edit'])->name('user.edit');
            Route::put('/{user}', [UserController::class, 'Update'])->name('user.update');
            Route::delete('/{user}', [UserController::class, 'Destroy'])->name('user.destroy');
        });
    }

    public function getRoutesApi()//: RouteModule
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb()//: ActionModule
    {
        //$permissoes[] = (new PermissionBlockResource("User", UserController::class))->toArray();
        //return new ActionModule(self::NAME, $permissoes);
    }
}
