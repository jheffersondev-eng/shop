<?php

namespace App\Repositories\UserDetail;

use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Models\UserDetail;

interface IUserDetailRepository
{
    public function findByDocument(string $document): UserDetail|null;
    public function getUserDetailByUserId(int $userId): UserDetail|null;
    public function create(UserDetailsDto $userDetailsDto): UserDetail;
    public function update(UserDetailsDto $userDetailsDto);
    public function delete(int $id);
}
