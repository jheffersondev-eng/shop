<?php

namespace App\Repositories\UserDetail;

use App\Http\Dto\UserDetail\CreateClientDto;
use App\Models\UserDetail;
use App\Repositories\BaseRepository;

class UserDetailRepository extends BaseRepository implements IUserDetailRepository
{
    public function __construct()
    {
        parent::__construct(new UserDetail());
    }

    public function store(CreateClientDto $createClientDto): UserDetail
    {
        return $this->model->create($createClientDto->toArray());
    }

    public function updateClientWithDto(CreateClientDto $createClientDto)
    {
        $client = $this->model->find($createClientDto->getUserId());
        if ($client) {
            $client->update($createClientDto->toArray());
            return $client;
        }
        return null;
    }
}
