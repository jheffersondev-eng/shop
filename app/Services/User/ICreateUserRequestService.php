<?php

namespace App\Services\User;

use App\Http\Requests\User\CreateUserRequest;

interface ICreateUserRequestService
{
    public function handler(CreateUserRequest $create): CreateUserRequest;
}