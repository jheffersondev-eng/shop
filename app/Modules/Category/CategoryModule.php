<?php

namespace App\Modules\Category;

use App\Http\Controllers\Category\CategoryController;
use App\Modules\Config\Module;
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
            Route::get('/', [CategoryController::class, 'Index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'Create'])->name('category.create');
            Route::post('/', [CategoryController::class, 'Store'])->name('category.store');
            Route::get('/{id}/edit', [CategoryController::class, 'Edit'])->name('category.edit');
            Route::put('/{id}', [CategoryController::class, 'Update'])->name('category.update');
            Route::delete('/{id}', [CategoryController::class, 'Destroy'])->name('category.destroy');
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
