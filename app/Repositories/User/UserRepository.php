<?php

namespace App\Repositories\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;
use Exception;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
