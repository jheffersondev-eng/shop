<?php

namespace App\Services;

use App\Http\Requests\Login\UserLoginRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Services\Login\UserLoginRequestService;
use App\Services\Login\UserRegisterRequestService;
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
        ];
    }

    public function handle($request)
    {
        $requestClass = get_class($request);
        if (!isset($this->map[$requestClass])) {
            throw new \Exception("Nenhum service mapeado para o request: $requestClass");
        }
        $serviceClass = $this->map[$requestClass];
        $service = App::make($serviceClass);
        return $service->handler($request);
    }
}
