<?php

namespace App\Repositories\Profile;

use App\Http\Dto\Profile\FilterDto;
use App\Http\Dto\Profile\ProfileDto;
use App\Models\Profile;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileRepository extends BaseRepository implements IProfileRepository
{
    const PAGINATION_SIZE = 10;
    protected int $userLoggedId;
    protected int $ownerId;

    public function __construct()
    {
        parent::__construct(new Profile());
        $this->userLoggedId = Auth::id();
        $this->ownerId = Auth::user()->owner_id;
    }

    public function getProfiles(): LengthAwarePaginator
    {
        return $this->model->where('user_id_created', '=', $this->userLoggedId)
            ->paginate(self::PAGINATION_SIZE);
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
            ->leftjoin('users as uc', 'p.user_id_created', '=', 'uc.id')
            ->leftJoin('users as uu', 'p.user_id_updated', '=', 'uu.id')
            ->leftjoin('user_details as udc', 'uc.id', '=', 'udc.user_id')
            ->leftJoin('user_details as udu', 'uu.id', '=', 'udu.user_id')
            ->select(
                    'p.id',
                    'p.name',
                    'p.description',
                    'p.permission',
                    'p.user_id_created',
                    'p.user_id_updated',
                    'udc.name as user_created_name',
                    'udu.name as user_updated_name',
                    'p.created_at',
                    'p.updated_at'
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, FilterDto $filterDto)
    {
        $query->whereNull('p.deleted_at')
            ->where(function($q) {
                $q->where('p.user_id_created', '=', $this->userLoggedId)
                    ->orWhere('p.owner_id', '=', $this->ownerId);
            });

        $query->whereNull('p.deleted_at');

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
            'name' => $profileDto->name,
            'description' => $profileDto->description,
            'permission' => $profileDto->permissions,
            'user_id_created' => $this->userLoggedId,
            'owner_id' => $this->ownerId,
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
            'name' => $profileDto->name,
            'description' => $profileDto->description,
            'permission' => $profileDto->permissions,
            'user_id_updated' => $this->userLoggedId,
        ];

        return $profile->update($data);
    }

    public function delete(int $id)
    {
        $profile = $this->model->find($id);

        if (!$profile) {
            throw new Exception('Perfil não encontrado');
        }

        $profile->user_id_deleted = $this->userLoggedId;
        $profile->deleted_at = now();
        
        return $profile->save();
    }
}
