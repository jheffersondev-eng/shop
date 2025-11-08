<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->setPages(10);
        $this->setName('Login');
        $this->setOrderList(['id', 'asc']);
        $this->setUrl(url("login"));
        $this->setFolderView("login");
    }

    public function Index(): View
    {
        return view( $this->getFolderView(). ".index", [
            'url' => $this->getUrl(),
            'title' => $this->getName()
        ]);
    }

    public function Login(UserLoginRequest $userLoginRequest): RedirectResponse
    {
        return parent::RedirectBase($userLoginRequest, 'Login realizado com sucesso', route('dashboard'));
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return parent::RedirectBase($request, 'Logout realizado com sucesso', route('login'));
    }
}