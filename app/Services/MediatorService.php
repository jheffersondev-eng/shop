<?php

namespace App\Services;

use App\Http\Requests\Login\UserLoginRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Services\Login\UserLoginRequestService;
use App\Services\Login\UserRegisterRequestService;
use App\Services\User\UserUpdateRequestService;
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
            UserUpdateRequest::class => UserUpdateRequestService::class,
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
