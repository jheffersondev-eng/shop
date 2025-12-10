<?php

namespace App\Repositories\User;

use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\User\UpdateUserDto;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function store(CreateUserDto $createUserDto)
    {
        $data = $createUserDto->toArray();
        return $this->createBase($data);
    }

    public function update(UpdateUserDto $updateUserDto)
    {
        $data = $updateUserDto->toArray();
        
        // Remove password do array se for nulo para não sobrescrever a senha existente
        if (is_null($data['password'] ?? null)) {
            unset($data['password']);
        }
        
        return $this->updateBase($updateUserDto->getId(), $data);
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
