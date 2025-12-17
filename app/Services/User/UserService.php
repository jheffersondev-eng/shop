<?php

namespace App\Services\User;

use App\Http\Dto\User\UserDto;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Services\ServiceResult;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserService implements IUserService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $userDetailRepository;

    public function __construct(IUserRepository $userRepository, IUserDetailRepository $userDetailRepository) 
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    public function getUsers(): LengthAwarePaginator
    {
        return $this->userRepository->getUsers();
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }
    
    public function create(UserDto $userDto): ServiceResult
    {
        try {
            $user = $this->userRepository->create($userDto);
            $userDto->userDetailsDto = $userDto->userDetailsDto->withUserId($user->id);
            $this->userDetailRepository->create($userDto->userDetailsDto);

            return ServiceResult::ok(
                data: $user,
                message: 'Usuário criado com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao criar usuário: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar usuário');
        }
    }
    
    public function update(UserDto $userDto, int $id): ServiceResult
    {
        try {
            $this->userRepository->update($userDto, $id);
            $userDto->userDetailsDto = $userDto->userDetailsDto->withUserId($id);
            $this->userDetailRepository->update($userDto->userDetailsDto);

            return ServiceResult::ok(
                message: 'Usuário atualizado com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao atualizar usuário: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao atualizar usuário');
        }
    }
    
    public function delete(int $id): ServiceResult
    {
        try {
            $this->userRepository->delete($id);
            $this->userDetailRepository->delete($id);

            return ServiceResult::ok(
                message: 'Usuário removido com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao remover usuário: '.$e->getMessage());
            return ServiceResult::fail('Erro ao remover usuário');
        }
    }
}
