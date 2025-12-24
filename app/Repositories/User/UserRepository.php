<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;
use Exception;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements IUserRepository
{
    const PAGINATION_SIZE = 10;

    public function __construct()
    {
        parent::__construct(new User());
    }

    public function getUsers(): LengthAwarePaginator
    {
        return $this->model->paginate(self::PAGINATION_SIZE);
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
            ->select(
                    'u.id as id',
                    'u.email as email',
                    'p.name as profile_name', 
                    'u.is_active as is_active',
                    'u.user_id_created as user_id_created',
                    'ud.name as detail_name',
                    'ud.document as document',
                    'ud.birth_date as birth_date',
                    'ud.phone as phone',
                    'ud.address as address',
                    'ud.credit_limit as credit_limit',
                    'u.created_at as created_at',
                    'u.updated_at as updated_at',
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, $filterDto)
    {
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
            'user_id_create' => $userDto->userIdCreate,
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
            'user_id_create' => $userDto->userIdCreate,
        ];

        if (is_null($data['password'] ?? null)) {
            unset($data['password']);
        }
        
        return $user->update($data);
    }

    public function delete(int $id)
    {
        $user = $this->model->find($id);

        if (!$user) {
            throw new Exception("Usuário não encontrado.");
        }
        
        return $user->delete();
    }
}
