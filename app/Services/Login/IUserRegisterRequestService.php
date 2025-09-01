<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserRegisterRequest;

interface IUserRegisterService
{
    public function handler(UserRegisterRequest $userRegisterRequest);
}