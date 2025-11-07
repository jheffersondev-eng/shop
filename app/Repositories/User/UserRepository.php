<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UpdateUserDto;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function getUsers()
    {
        return $this->model->withoutTrashed()->get();
    }

    public function getUserById($id)
    {
        return $this->model->withoutTrashed()->find($id);
    }

    public function updateUserWithDto(UpdateUserDto $updateUserDto)
    {
        $user = $this->getUserById($updateUserDto->getId());
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }   
}
