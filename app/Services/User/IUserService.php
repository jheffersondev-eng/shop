<?php

namespace App\Services\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserService
{
    public function getUsers(): LengthAwarePaginator;
    public function getUserById(int $id): User;
    public function create(UserDto $userDto): ServiceResult;
    public function update(UserDto $userDto, int $id): ServiceResult;
    public function delete(int $id): ServiceResult;
}