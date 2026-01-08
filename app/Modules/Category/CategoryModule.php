<?php

namespace App\Modules\Category;

use App\Http\Controllers\Category\CategoryController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlock;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class CategoryModule extends Module
{
    public function register(Application $app)
    {
    }

    public function boot()
    {
    }

    public function getRoutesWeb()
    {
        return new RouteModule('category', function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
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
        $permissions = new PermissionBlock("Category", CategoryController::class);
        
        $permissions->addAction('Consultar', 'Index')
            ->addAction("Cadastrar", "store")
            ->addAction("Atualizar", "update")
            ->addAction("Remover", "destroy");
        
        return new ActionModule('Categoria', $permissions->toArray()['actions']);
    }
}
