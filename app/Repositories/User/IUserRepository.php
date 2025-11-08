<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;

interface IUserRepository
{
    public function update(UserDto $userDto);
    public function store(UserDto $userDto);
    public function delete(User $user);
    public function getUsers();
    public function findByEmail(string $email): ?User;
}