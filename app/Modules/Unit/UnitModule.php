<?php

namespace App\Modules\Unit;

use App\Http\Controllers\Unit\UnitController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlock;
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
            Route::get('/', [UnitController::class, 'index'])->name('unit.index');
            Route::get('/create', [UnitController::class, 'create'])->name('unit.create');
            Route::post('/', [UnitController::class, 'store'])->name('unit.store');
            Route::get('/{id}/edit', [UnitController::class, 'edit'])->name('unit.edit');
            Route::put('/{id}', [UnitController::class, 'update'])->name('unit.update');
            Route::delete('/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
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
        $permissions = new PermissionBlock("Unit", UnitController::class);
        
        $permissions->addAction('Consultar', 'Index')
            ->addAction("Cadastrar", "store")
            ->addAction("Atualizar", "update")
            ->addAction("Remover", "destroy");
        
        return new ActionModule('Unidade', $permissions->toArray()['actions']);
    }
}
