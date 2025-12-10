<?php

namespace App\Repositories\UserDetail;

use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Models\UserDetail;
use App\Repositories\BaseRepository;

class UserDetailRepository extends BaseRepository implements IUserDetailRepository
{
    public function __construct()
    {
        parent::__construct(new UserDetail());
    }

    public function store(UserDetailsDto $userDetailsDto): UserDetail
    {
        return $this->model->create($userDetailsDto->toArray());
    }

    public function update(UserDetailsDto $userDetailsDto)
    {
        $userDetail = $this->model->where('user_id', $userDetailsDto->getUserId())->first();
        if ($userDetail) {
            $userDetail->update($userDetailsDto->toArray());
            return $userDetail;
        }
        return null;
    }
}
