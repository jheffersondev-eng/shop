<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserLoginRequest;
use App\Services\ServiceResult;

interface ILoginService
{
    public function handler(UserLoginRequest $userLoginRequest): ServiceResult;
}