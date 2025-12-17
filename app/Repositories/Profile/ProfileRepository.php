<?php

namespace App\Repositories\Profile;

use App\Http\Dto\Profile\ProfileDto;
use App\Models\Profile;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileRepository extends BaseRepository implements IProfileRepository
{
    const PAGINATION_SIZE = 10;

    public function __construct()
    {
        parent::__construct(new Profile());
    }

    public function getProfiles(): LengthAwarePaginator
    {
        return $this->model->paginate(self::PAGINATION_SIZE);
    }

    public function getProfileById(int $id): Profile
    {
        $profile = $this->model->find($id);
        
        if (!$profile) {
            throw new Exception('Perfil não encontrado');
        }

        return $profile;
    }

    public function create(ProfileDto $profileDto): Profile
    {
        $data = [
            'name' => $profileDto->name
        ];

        return $this->model->create($data);
    }

    public function update(int $id, ProfileDto $profileDto)
    {
        $profile = $this->model->find($id);
        if (!$profile) {
            throw new Exception('Perfil não encontrado');
        }

        $data = [
            'name' => $profileDto->name
        ];

        return $profile->update($data);
    }

    public function delete(int $id)
    {
        $profile = $this->model->find($id);

        if (!$profile) {
            throw new Exception('Perfil não encontrado');
        }

        return $profile->delete();
    }
}
