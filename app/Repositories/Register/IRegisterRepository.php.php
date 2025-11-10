<?php

namespace App\Repositories\Register;

use App\Http\Requests\Login\UserReplaceRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Models\User;

interface IRegisterRepository
{
    public function store(UserRegisterRequest $userRegisterRequest);

    public function replace(User $user, UserReplaceRequest $userReplaceRequest);

    public function destroy(User $user);
}