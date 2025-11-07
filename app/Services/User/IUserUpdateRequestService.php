<?php

namespace App\Services\User;

use App\Http\Requests\User\UserUpdateRequest;

interface IUserUpdateRequestService
{
    public function handler(UserUpdateRequest $userUpdateRequest);
}