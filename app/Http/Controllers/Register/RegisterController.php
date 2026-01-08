<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Http\Requests\Login\VerifyEmailRequest;
use App\Http\Requests\Login\viewVerifyRequest;
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

    public function signUp(): View
    {
        return view('register.create', [
            'url' => route('register.create'),
            'title' => 'Cadastre-se',
        ]);
    }

    public function register(UserRegisterRequest $userRegisterRequest): RedirectResponse
    {
        $dto = $userRegisterRequest->getDto();

        return $this->execute(
            callback: fn() => $this->userService->create($dto),
            defaultSuccessMessage: 'Usuario criado com sucesso',
            successRedirect: null,
        );
    }

    public function verifyEmailView(viewVerifyRequest $request): View
    {
        $dto = $request->getDto();

        return view('register.verify-email', [
            'userId' => $dto->userId,
            'email' => $dto->email,
        ]);
    }

    public function verifyEmail(VerifyEmailRequest $request): RedirectResponse
    {
        $dto = $request->getDto();

        return $this->execute(
            callback: fn() => $this->userService->verifyEmail($dto->userId, $dto->verificationCode),
            defaultSuccessMessage: 'Email verificado com sucesso!',
            successRedirect: route('user.index'),
        );
    }
}