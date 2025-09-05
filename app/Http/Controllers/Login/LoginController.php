<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserLoginRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Repositories\Login\ILoginRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function __construct(ILoginRepository $loginRepository)
    {
        parent::__construct($loginRepository);

        $this->setPages(10);
        $this->setName('Login');
        $this->setOrderList(['id', 'asc']);
        $this->setUrl(url("login"));
        $this->setFolderView("login");
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request);
    }

    public function SignUp()
    {
        return parent::CreateBase();
    }

    public function Login(UserLoginRequest $userLoginRequest)
    {
        return parent::RedirectBase($userLoginRequest, 'Login realizado com sucesso', route('dashboard'));
    }

    public function Register(UserRegisterRequest $userRegisterRequest)
    {
        return parent::StoreBase($userRegisterRequest);
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return parent::RedirectBase($request, 'Logout realizado com sucesso', route('login'));
    }
}