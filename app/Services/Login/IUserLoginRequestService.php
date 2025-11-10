<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserLoginRequest;

interface IUserLoginRequestService
{
    public function handler(UserLoginRequest $userLoginRequest);
}