<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserLoginRequest;
use App\Services\Login\IUserLoginRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LoginController extends BaseController
{
    protected IUserLoginRequestService $userLoginRequestService;

    public function __construct(IUserLoginRequestService $userLoginRequestService)
    {
        $this->userLoginRequestService = $userLoginRequestService;
    }

    protected function getFolderView(): string
    {
        return "login";
    }

    protected function getUrl(): string
    {
        return "login";
    }

    protected function getName(): string
    {
        return "Login";
    }

    public function Index(): View
    {
        return view( $this->getFolderView(). ".index", [
            'url' => $this->getUrl(),
            'title' => $this->getName()
        ]);
    }

    public function Login(UserLoginRequest $request): RedirectResponse
    {
        return $this->execute(
            callback: fn() => $this->userLoginRequestService->handler($request),
            defaultSuccessMessage: 'Login realizado com sucesso',
            successRedirect: route('dashboard'),
        );
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to($this->getUrl());
    }
}