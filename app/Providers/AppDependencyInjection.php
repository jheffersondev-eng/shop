<?php

namespace App\Providers;

use App\Repositories\Login\ILoginRepository;
use App\Repositories\Login\LoginRepository;
use App\Services\Login\IUserLoginRequestService;
use App\Services\Login\IUserRegisterRequestService;
use App\Services\Login\UserLoginRequestService;
use App\Services\Login\UserRegisterRequestService;
use Illuminate\Contracts\Foundation\Application;

class AppDependencyInjection
{
    public static function register(Application $app)
    {
        $app->bind(ILoginRepository::class, LoginRepository::class);
        $app->bind(IUserRegisterRequestService::class, UserRegisterRequestService::class);
        $app->bind(IUserLoginRequestService::class, UserLoginRequestService::class);
    }
}