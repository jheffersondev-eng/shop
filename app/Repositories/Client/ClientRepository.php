<?php

namespace App\Repositories\Client;

use App\Http\Dto\Client\CreateClientDto;
use App\Models\Client;
use App\Repositories\BaseRepository;

class ClientRepository extends BaseRepository implements IClientRepository
{
    public function __construct()
    {
        parent::__construct(new Client());
    }

    public function store(CreateClientDto $createClientDto): Client
    {
        return $this->model->create($createClientDto->toArray());
    }
}