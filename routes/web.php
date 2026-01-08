<?php

use App\Http\Controllers\Login\LoginController;
use App\Modules\Config\Configuration;
use App\Modules\Login\LoginModule;
use App\Modules\Register\RegisterModule;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Authenticate;
use App\Modules\Home\HomeModule;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/shortly', function () {
    return view('home.shortly');
})->name('shortly');

// Rota de logout (sem middleware de redirect)
Route::get('/login/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas públicas (sem autenticação, mas redireciona se autenticado)
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    $modules = [
        new LoginModule(),
        new RegisterModule(),
        new HomeModule(),
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
