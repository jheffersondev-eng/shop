<?php

namespace App\Repositories\Client;

use App\Http\Dto\Client\CreateClientDto;
use App\Models\Client;

interface IClientRepository
{
    public function store(CreateClientDto $createClientDto): Client;
}