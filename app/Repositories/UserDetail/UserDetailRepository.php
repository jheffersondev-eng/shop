<?php

namespace App\Repositories\UserDetail;

use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Models\UserDetail;
use App\Repositories\BaseRepository;
use Exception;

class UserDetailRepository extends BaseRepository implements IUserDetailRepository
{
    public function __construct()
    {
        parent::__construct(new UserDetail());
    }

    public function create(UserDetailsDto $userDetailsDto): UserDetail
    {
        return $this->model->create($userDetailsDto->toArray());
    }

    public function delete(int $id)
    {
        $userDetail = $this->model->where('user_id', $id)->first();

        if (!$userDetail) {
            return throw new Exception("Detalhes do usuário não encontrados.");
        }

        return $userDetail->delete();
    }

    public function update(UserDetailsDto $userDetailsDto)
    {
        $userDetail = $this->model->where('user_id', $userDetailsDto->userId)->first();

        if (!$userDetail) {
            return throw new Exception("Detalhes do usuário não encontrados.");
        }

        $data = [
            'name' => $userDetailsDto->name,
            'document' => $userDetailsDto->document,
            'birthDate' => $userDetailsDto->birthDate,
            'phone' => $userDetailsDto->phone,
            'address' => $userDetailsDto->address,
            'creditLimit' => $userDetailsDto->creditLimit,
        ];
        
        return $userDetail->update($data);
    }
}
