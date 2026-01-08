<?php

namespace App\Modules\User;

use App\Http\Controllers\User\UserController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlock;
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
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/create', [UserController::class, 'store'])->name('user.store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        });
    }

    public function getRoutesApi()//: RouteModule
    {
    }

    public function getReports()
    {
    }

    public function getActionsWeb(): ActionModule
    {
        $permissions = new PermissionBlock("User", UserController::class);
        
        $permissions->addAction('Consultar', 'Index')
            ->addAction("Cadastrar", "store")
            ->addAction("Atualizar", "update")
            ->addAction("Remover", "destroy");
        
        return new ActionModule('Usuário', $permissions->toArray()['actions']);
    }
}
