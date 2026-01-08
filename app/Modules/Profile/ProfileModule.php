<?php

namespace App\Modules\Profile;

use App\Http\Controllers\Profile\ProfileController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlock;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class ProfileModule extends Module
{
    public function register(Application $app)
    {
    }

    public function boot()
    {
    }

    public function getRoutesWeb()
    {
        return new RouteModule('profile', function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
            Route::get('/create', [ProfileController::class, 'create'])->name('profile.create');
            Route::post('/', [ProfileController::class, 'store'])->name('profile.store');
            Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::put('/{id}', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
        $permissions = new PermissionBlock("Profile", ProfileController::class);
        
        $permissions->addAction('Consultar', 'Index')
            ->addAction("Cadastrar", "store")
            ->addAction("Atualizar", "update")
            ->addAction("Remover", "destroy");
        
        return new ActionModule('Perfil', $permissions->toArray()['actions']);
    }
}
