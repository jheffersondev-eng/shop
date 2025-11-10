<?php

namespace App\Services\User;

use App\Http\Requests\User\UpdateUserRequest;

interface IUpdateUserRequestService
{
    public function handler(UpdateUserRequest $updateUserRequest);
}