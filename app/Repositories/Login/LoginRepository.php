<?php

namespace App\Repositories\Login;

use App\Http\Requests\Login\UserReplaceRequest;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Models\User;
use App\Repositories\BaseRepository;

class LoginRepository extends BaseRepository implements ILoginRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function store(UserRegisterRequest $userRegisterRequest)
    {
        $this->model->create($userRegisterRequest->validated());
    }

    public function replace(User $user, UserReplaceRequest $userReplaceRequest)
    {
        // Implement the logic to replace a user
    }

    public function destroy(User $user)
    {
        // Implement the logic to destroy a user
    }
}