<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function store(UserDto $userDto)
    {
        $data = $userDto->toArray();
        return $this->model->create($data);
    }

    public function update(UserDto $userDto)
    {
        $user = $this->model->withoutTrashed()->find($userDto->getId());
        if ($user) {
            $user->update($userDto->toArray());
            return $user;
        }
        return null;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function getUsers()
    {
        return $this->model->withoutTrashed()->get();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
