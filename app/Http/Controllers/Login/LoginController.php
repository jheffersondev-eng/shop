<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserLoginRequest;
use App\Services\Login\ILoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LoginController extends BaseController
{
    protected ILoginService $loginService;

    public function __construct(ILoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index(): View
    {
        return view("login.index", [
            'url' => route('login'),
            'title' => 'Login',
        ]);
    }

    public function login(UserLoginRequest $request): RedirectResponse
    {
        return $this->execute(
            callback: fn() => $this->loginService->handler($request),
            defaultSuccessMessage: 'Login realizado com sucesso',
            successRedirect: null,
        );
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to($this->getUrl());
    }
}