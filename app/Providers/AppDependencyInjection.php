<?php

namespace App\Providers;

use App\Repositories\Login\ILoginRepository;
use App\Repositories\Login\LoginRepository;
use App\Services\Login\IUserRegisterService;
use App\Services\Login\UserRegisterService;
use Illuminate\Contracts\Foundation\Application;

class AppDependencyInjection
{
    public static function register(Application $app)
    {
        $app->bind(ILoginRepository::class, LoginRepository::class);
        $app->bind(IUserRegisterService::class, UserRegisterService::class);
    }
}