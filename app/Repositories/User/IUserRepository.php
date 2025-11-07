<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UpdateUserDto;
use App\Models\User;

interface IUserRepository
{
    public function getUsers();
    public function getUserById($id);
    public function updateUserWithDto(UpdateUserDto $updateUserDto);
    public function delete(User $user);
    public function find($id);
}