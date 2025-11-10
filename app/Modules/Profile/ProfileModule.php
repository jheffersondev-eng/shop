<?php

namespace App\Modules\Profile;

use App\Http\Controllers\Profile\ProfileController;
use App\Modules\Config\Module;
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
    }
}
