<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Services\User\IUserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends BaseController
{
    protected IUserService $userService;

    public function __construct(
        IUserService $userService
    ) 
    {
        $this->userService = $userService;
    }

    public function SignUp(): View
    {
        return view('register.create', [
            'url' => route('register.create'),
            'title' => 'Cadastre-se',
        ]);
    }

    public function Register(UserRegisterRequest $userRegisterRequest): RedirectResponse
    {
        $dto = $userRegisterRequest->getDto();

        return $this->execute(
            callback: fn() => $this->userService->create($dto),
            defaultSuccessMessage: 'Usuário criado com sucesso',
            successRedirect: route('user.index'),
        );
    }
}