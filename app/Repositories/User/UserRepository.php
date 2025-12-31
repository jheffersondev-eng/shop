<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;
use Exception;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements IUserRepository
{
    const PAGINATION_SIZE = 10;
    protected ?int $userLoggedId;
    protected ?int $ownerId;

    public function __construct()
    {
        parent::__construct(new User());
        $this->userLoggedId = Auth::id() ?? null;
        $this->ownerId = $this->userLoggedId ? Auth::user()->owner_id : null;
    }

    public function getUsers(): LengthAwarePaginator
    {
        return $this->model->where('user_id_created', '=', $this->userLoggedId)
            ->paginate(self::PAGINATION_SIZE);
    }

    public function getUserById(int $id): User
    {
        $user = $this->model->find($id);

        if (!$user) {
            throw new Exception("Usuário não encontrado.");
        }

        return $user;
    }

    public function findByEmail(string $email): User|null
    {
        return $this->model->where('email', $email)->first();
    }

    public function getUsersByFilter($filterDto): LengthAwarePaginator
    {
        $query = DB::table('users as u')
            ->join('user_details as ud', 'ud.user_id', '=', 'u.id')
            ->join('profiles as p', 'u.profile_id', '=', 'p.id')
            ->leftJoin('users as uc', 'u.user_id_created', '=', 'uc.id')
            ->leftJoin('user_details as udc', 'uc.id', '=', 'udc.user_id')
            ->leftJoin('users as uu', 'u.user_id_updated', '=', 'uu.id')
            ->leftJoin('user_details as udu', 'uu.id', '=', 'udu.user_id')
            ->select(
                    'u.id as id',
                    'u.email as email',
                    'p.name as profile_name',
                    'p.description as profile_description',
                    'p.permission as profile_permissions',
                    'u.is_active as is_active',
                    'u.user_id_created as user_id_created',
                    'ud.name as detail_name',
                    'ud.document as document',
                    'ud.birth_date as birth_date',
                    'ud.phone as phone',
                    'ud.address as address',
                    'ud.credit_limit as credit_limit',
                    'ud.image as image',
                    'u.user_id_created as user_id_created',
                    'u.user_id_updated as user_id_updated',
                    'udc.name as user_created_name',
                    'udu.name as user_updated_name',
                    'u.created_at as created_at',
                    'u.updated_at as updated_at',
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, $filterDto)
    {
        $query->whereNull('u.deleted_at')
            ->where(function($q) {
                $q->where('u.user_id_created', '=', $this->userLoggedId)
                    ->orWhere('u.owner_id', '=', $this->ownerId);
            });

        if ($filterDto->id) {
            $query->where('u.id', $filterDto->id);
        }

        if ($filterDto->name) {
            $query->where('ud.name', 'like', '%'.$filterDto->name.'%');
        }

        if ($filterDto->email) {
            $query->where('u.email', 'like', '%'.$filterDto->email.'%');
        }

        if ($filterDto->profileId) {
            $query->where('u.profile_id', $filterDto->profileId);
        }

        if (!is_null($filterDto->isActive)) {
            $query->where('u.is_active', $filterDto->isActive);
        }

        if ($filterDto->dateDe) {
            $query->whereDate('u.created_at', '>=', $filterDto->dateDe->toDateString());
        }

        if ($filterDto->dateAte) {
            $query->whereDate('u.created_at', '<=', $filterDto->dateAte->toDateString());
        }

        return $query;
    }

    public function create(UserDto $userDto): User
    {
        $data = [
            'email' => $userDto->email,
            'password' => $userDto->password,
            'is_active' => $userDto->isActive,
            'profile_id' => $userDto->profileId,
            'user_id_created' => $this->userLoggedId,
        ];

        return $this->model->create($data);
    }

    public function update(UserDto $userDto, int $id)
    {
        $user = $this->model->find($id);
        
        if (!$user) {
            throw new Exception("Usuário não encontrado.");
        }

        $data = [
            'email' => $userDto->email,
            'password' => $userDto->password,
            'is_active' => $userDto->isActive,
            'profile_id' => $userDto->profileId,
            'user_id_updated' => $this->userLoggedId,
        ];

        if (is_null($data['password'] ?? null)) {
            unset($data['password']);
        }
        
        return $user->update($data);
    }

    public function save(User $user): User
    {
        $user->save();
        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->model->find($id);
        
        if (!$user) {
            throw new Exception("Usuário não encontrado.");
        }

        $user->user_id_deleted = $this->userLoggedId;
        $user->deleted_at = now();
        
        return $user->save();
    }

    public function getUserCountByMonth(Carbon $date): int
    {
        $count = $this->model
            ->where('owner_id', $this->ownerId)
            ->whereBetween('created_at', [
                $date->copy()->startOfMonth(),
                $date->copy()->endOfMonth()
            ])
            ->count();

        return $count;
    }
}
