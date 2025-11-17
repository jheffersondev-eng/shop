<?php

namespace App\Modules\Unit;

use App\Http\Controllers\Unit\UnitController;
use App\Modules\Config\Module;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class UnitModule extends Module
{
    public function register(Application $app)
    {
    }

    public function boot()
    {
    }

    public function getRoutesWeb()
    {
        return new RouteModule('unit', function () {
            Route::get('/', [UnitController::class, 'Index'])->name('unit.index');
            Route::get('/create', [UnitController::class, 'Create'])->name('unit.create');
            Route::post('/', [UnitController::class, 'Store'])->name('unit.store');
            Route::get('/{id}/edit', [UnitController::class, 'Edit'])->name('unit.edit');
            Route::put('/{id}', [UnitController::class, 'Update'])->name('unit.update');
            Route::delete('/{id}', [UnitController::class, 'Destroy'])->name('unit.destroy');
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
