<?php

use App\Modules\Config\Configuration;
use App\Modules\Login\LoginModule;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

// Rotas públicas (sem autenticação)
Route::middleware([])->group(function () {
    $modules = [
        new LoginModule(),
    ];

    foreach ($modules as $module) {
        $routesWeb = $module->getRoutesWeb();
        if ($routesWeb === null) {
            continue;
        }

        $route = Route::prefix($routesWeb->getPrefix());

        if (!empty($routesWeb->getNamespace())) {
            $route->namespace($routesWeb->getNamespace());
        }

        $route->group($routesWeb->getRoutes());
    }
});

// Rotas protegidas (com autenticação)
Route::middleware(['auth'])->group(function () {
    $modules = Configuration::getModules();

    foreach ($modules as $module) {
        $routesWeb = $module->getRoutesWeb();
        if ($routesWeb === null) {
            continue;
        }

        $route = Route::prefix($routesWeb->getPrefix());

        if (!empty($routesWeb->getNamespace())) {
            $route->namespace($routesWeb->getNamespace());
        }

        $route->group($routesWeb->getRoutes());
    }
});

