<?php

namespace App\Modules\Company;

use App\Http\Controllers\Company\CompanyController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlockResource;
use App\Modules\Config\RouteModule;
use Illuminate\Support\Facades\Route;

class CompanyModule extends Module
{
    public function getRoutesWeb(): RouteModule
    {
        return new RouteModule("company", function () {
            Route::get('/', [CompanyController::class, 'index'])->name('company.index');
            Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
            Route::post('/', [CompanyController::class, 'store'])->name('company.store');
            Route::get('/edit', [CompanyController::class, 'edit'])->name('company.edit');
            Route::put('/edit', [CompanyController::class, 'update'])->name('company.update');
            Route::delete('/delete', [CompanyController::class, 'destroy'])->name('company.destroy');
        });
    }

    public function getActionsWeb()
    {
        $permissions = new PermissionBlockResource("Company", CompanyController::class);
        return new ActionModule('Company', $permissions->toArray()['actions']);
    }
}
