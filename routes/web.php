<?php

use App\Modules\Config\Configuration;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::middleware([])->group(function () {
    $modules = Configuration::getModules();

    foreach ($modules as $module) {
        $routesWeb = $module->getRoutesWeb();
        if ($routesWeb === null) {
            continue;
        }

        $route = Route::prefix($routesWeb->getNamespace());

        if (!empty($routesWeb->getNamespace())) {
            $route->namespace($routesWeb->getNamespace());
        }

        $route->group($routesWeb->getRoutes());
    }
});

