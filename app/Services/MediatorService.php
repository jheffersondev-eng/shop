<?php

namespace App\Services;

use App\Http\Requests\Login\UserLoginRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Login\UserLoginRequestService;
use App\Services\Login\UserRegisterRequestService;
use App\Services\Product\ProductRequestService;
use App\Services\Product\ProductUpdateRequestService;
use App\Services\User\UpdateUserRequestService;
use App\Services\User\CreateUserRequestService;
use Illuminate\Support\Facades\App;

class MediatorService
{
    /**
     * Mapeamento de Request => Service
     * Exemplo: [UserRegisterRequest::class => UserRegisterRequestService::class]
     */
    protected array $map = [];

    public function __construct()
    {
        // Registre os mapeamentos aqui
        $this->map = [
            UserRegisterRequest::class => UserRegisterRequestService::class,
            UserLoginRequest::class => UserLoginRequestService::class,
            UpdateUserRequest::class => UpdateUserRequestService::class,
            CreateUserRequest::class => CreateUserRequestService::class,
            ProductRequest::class => ProductRequestService::class,
            ProductUpdateRequest::class => ProductUpdateRequestService::class,
        ];
    }

    public function handle($request)
    {
        foreach ($this->map as $requestClass => $serviceClass) {
            if ($request instanceof $requestClass) {
                $service = App::make($serviceClass);
                return $service->handler($request);
            }
        }

        return null;
    }
}
