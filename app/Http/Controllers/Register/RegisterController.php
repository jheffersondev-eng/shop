<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserRegisterRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends BaseController
{
    public function __construct()
    {
        $this->setPages(1);
        $this->setName('Novo Usuário');
        $this->setUrl(url('register'));
        $this->setFolderView('register');
    }

    public function SignUp(): View
    {
        return parent::CreateBase();
    }

    public function Register(UserRegisterRequest $userRegisterRequest): RedirectResponse
    {
        return parent::StoreBase($userRegisterRequest);
    }
}