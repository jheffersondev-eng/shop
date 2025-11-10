<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserRegisterRequest;

interface IUserRegisterRequestService
{
    public function handler(UserRegisterRequest $userRegisterRequest): UserRegisterRequest;
}