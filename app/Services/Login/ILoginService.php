<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserLoginRequest;

interface ILoginService
{
    public function handler(UserLoginRequest $userLoginRequest);
}