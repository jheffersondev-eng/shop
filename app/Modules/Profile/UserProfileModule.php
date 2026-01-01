<?php

namespace App\Modules\Profile;

use App\Http\Controllers\User\UserProfileController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlock;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class UserProfileModule extends Module
{
    public function register(Application $app)
    {
    }

    public function boot()
    {
    }

    public function getRoutesWeb()
    {
        return new RouteModule('my-profile', function () {
            Route::get('/{user}/edit', [UserProfileController::class, 'Edit'])->name('userProfile.edit');
            Route::put('/{user}', [UserProfileController::class, 'Update'])->name('userProfile.update');
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
        $permissions = new PermissionBlock("UserProfile", UserProfileController::class);
        
        $permissions->addAction('Ver Perfil', 'Edit')
            ->addAction("Atualizar", "update");
        
        return new ActionModule('Meu Perfil', $permissions->toArray()['actions']);
    }
}
