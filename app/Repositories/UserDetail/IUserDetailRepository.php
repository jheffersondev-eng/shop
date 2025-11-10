<?php

namespace App\Repositories\UserDetail;

use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Models\UserDetail;

interface IUserDetailRepository
{
    public function store(UserDetailsDto $userDetailsDto): UserDetail;
    public function update(UserDetailsDto $userDetailsDto);
}
