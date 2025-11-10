<?php

namespace App\Repositories\User;

use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\User\UpdateUserDto;
use App\Models\User;

interface IUserRepository
{
    public function update(UpdateUserDto $updateUserDto);
    public function store(CreateUserDto $createUserDto);
    public function delete(User $user);
    public function getUsers();
    public function findByEmail(string $email): ?User;
}