<?php

namespace App\Modules\Profile;

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\UserProfileController;
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
            Route::get('/', [ProfileController::class, 'Index'])->name('profile.index');
            Route::get('/create', [ProfileController::class, 'Create'])->name('profile.create');
            Route::post('/', [ProfileController::class, 'Store'])->name('profile.store');
            Route::get('/{id}/edit', [ProfileController::class, 'Edit'])->name('profile.edit');
            Route::put('/{id}', [ProfileController::class, 'Update'])->name('profile.update');
            Route::delete('/{id}', [ProfileController::class, 'Destroy'])->name('profile.destroy');

            Route::get('/profile/{user}/edit', [UserProfileController::class, 'Edit'])->name('userProfile.edit');
            Route::put('/profile/{user}', [UserProfileController::class, 'Update'])->name('userProfile.update');
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
