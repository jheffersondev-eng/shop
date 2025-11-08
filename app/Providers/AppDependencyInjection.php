<?php

namespace App\Providers;

use App\Repositories\UserDetail\UserDetailRepository;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Profile\IProfileRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Services\Login\IUserLoginRequestService;
use App\Services\Login\IUserRegisterRequestService;
use App\Services\Login\UserLoginRequestService;
use App\Services\Login\UserRegisterRequestService;
use Illuminate\Contracts\Foundation\Application;

class AppDependencyInjection
{
    public static function register(Application $app)
    {
        $app->bind(IUserDetailRepository::class, UserDetailRepository::class);
        $app->bind(IUserRepository::class, UserRepository::class);
        $app->bind(IProfileRepository::class, ProfileRepository::class);

        //register bindings services
        $app->bind(IUserRegisterRequestService::class, UserRegisterRequestService::class);
        $app->bind(IUserLoginRequestService::class, UserLoginRequestService::class);
    }
}