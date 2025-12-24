<?php

namespace App\Repositories\Profile;

use App\Http\Dto\Profile\FilterDto;
use App\Http\Dto\Profile\ProfileDto;
use App\Models\Profile;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function getProfilesByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        $query = DB::table('profiles as p')
            ->select(
                    'p.id',
                    'p.name',
                    'p.description',
                    'p.user_id_created',
                    'p.user_id_updated',
                    'p.created_at',
                    'p.updated_at'
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, FilterDto $filterDto)
    {
        if ($filterDto->id) {
            $query->where('id', $filterDto->id);
        }

        if ($filterDto->name) {
            $query->where('name', 'like', '%' . $filterDto->name . '%');
        }

        if ($filterDto->dateDe) {
            $query->whereDate('created_at', '>=', $filterDto->dateDe);
        }

        if ($filterDto->dateAte) {
            $query->whereDate('created_at', '<=', $filterDto->dateAte);
        }

        return $query;
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
