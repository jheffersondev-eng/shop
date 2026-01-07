<?php

use App\Modules\Config\Configuration;
use App\Modules\Login\LoginModule;
use App\Modules\Register\RegisterModule;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Authenticate;

Route::get('/', function () {
    return view('home.index');
});

// Rotas públicas (sem autenticação, mas redireciona se autenticado)
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    $modules = [
        new LoginModule(),
        new RegisterModule(),
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

// Rotas protegidas (com autenticação E verificação de permissões)
Route::middleware([Authenticate::class, CheckPermission::class])->group(function () {
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
