<?php

namespace App\Repositories\UserDetail;

use App\Http\Dto\UserDetail\CreateClientDto;
use App\Models\UserDetail;

interface IUserDetailRepository
{
    public function store(CreateClientDto $createClientDto): UserDetail;
    public function updateClientWithDto(CreateClientDto $createClientDto);
}
