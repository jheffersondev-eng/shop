<?php

namespace App\Repositories\Login;

use App\Http\Requests\Login\UserReplaceRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Models\User;

interface ILoginRepository
{
    public function store(UserRegisterRequest $userRegisterRequest);

    public function replace(User $user, UserReplaceRequest $userReplaceRequest);

    public function destroy(User $user);
}