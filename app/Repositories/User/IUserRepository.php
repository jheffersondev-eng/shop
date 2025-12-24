<?php

namespace App\Repositories\User;

use App\Http\Dto\User\FilterDto;
use App\Http\Dto\User\UserDto;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function getUsers();
    public function getUserById(int $id): User;
    public function findByEmail(string $email): User|null;
    public function getUsersByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function create(UserDto $userDto): User;
    public function update(UserDto $userDto, int $id);
    public function delete(int $id);
}