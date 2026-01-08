<?php

namespace App\Modules\Product;

use App\Http\Controllers\Product\ProductController;
use App\Modules\Config\ActionModule;
use App\Modules\Config\Module;
use App\Modules\Config\PermissionBlockResource;
use App\Modules\Config\RouteModule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

class ProductModule extends Module
{
    public function register(Application $app)
    {
    }

    public function boot()
    {
    }

    public function getRoutesWeb()
    {
        return new RouteModule('product', function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/', [ProductController::class, 'store'])->name('product.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
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
        $permissions = new PermissionBlockResource("Product", ProductController::class);
        return new ActionModule('Produto', $permissions->toArray()['actions']);
    }
}