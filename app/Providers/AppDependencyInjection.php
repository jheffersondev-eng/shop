<?php

namespace App\Providers;

use App\Repositories\Client\ClientRepository;
use App\Repositories\Client\IClientRepository;
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
        //register bindings repositories
        $app->bind(ILoginRepository::class, LoginRepository::class);
        $app->bind(IClientRepository::class, ClientRepository::class);
        
        //register bindings services
        $app->bind(IUserRegisterRequestService::class, UserRegisterRequestService::class);
        $app->bind(IUserLoginRequestService::class, UserLoginRequestService::class);
    }
}