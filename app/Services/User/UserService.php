<?php

namespace App\Services\User;

use App\Http\Dto\User\FilterDto;
use App\Http\Dto\User\UserDto;
use App\Mapper\UserAggregateMapper;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Services\ServiceResult;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        try {
            $users = $this->userRepository->getUsers();
            return $users;

        } catch (Throwable $e) {
            Log::error('Erro ao listar usuários: '.$e->getMessage());
            throw $e;
        }
    }

    public function getUserById(int $id): User
    {
        try {
            $user = $this->userRepository->getUserById($id);
            return $user;

        } catch (Throwable $e) {
            Log::error('Erro ao obter usuário por ID: '.$e->getMessage());
            throw $e;
        }
    }

    public function getUsersByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        try {
            $users = $this->userRepository->getUsersByFilter($filterDto);
            $usersAggregate = UserAggregateMapper::map($users);
            
            return $usersAggregate;
        } catch (Throwable $e) {
            Log::error('Erro ao filtrar usuários: '.$e->getMessage());
            throw $e;
        }
    }

    private function deleteOldImage(string|null $image): void
    {
        if ($image && Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }
    
    public function create(UserDto $userDto): ServiceResult
    {
        try {
            $userDto->ownerId = Auth::id();

            $email = $this->userRepository->findByEmail($userDto->email);
            if ($email) {
                return ServiceResult::fail('E-mail já cadastrado');
            }

            $document = $this->userDetailRepository->findByDocument($userDto->userDetailsDto->document);
            if ($document) {
                return ServiceResult::fail('Documento já cadastrado');
            }

            if($userDto->userDetailsDto->birthDate > now()->subYears(17)->toDateString()) {
                return ServiceResult::fail('Usuário deve ser maior de 18 anos');
            }
            
            $user = $this->userRepository->create($userDto);
            $user->owner_id = $userDto->ownerId ?? $user->id;
            $this->userRepository->save($user);
            $userDto->userDetailsDto->userId = $user->id;
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
            $userDetail = $this->userDetailRepository->getUserDetailByUserId($id);
            $userDto->userDetailsDto->userId = $id;
            
            if ($userDto->userDetailsDto->image instanceof UploadedFile) {
                $this->deleteOldImage($userDetail->image);
                $userDto->userDetailsDto->image = $userDto->userDetailsDto->image->store('users', 'public');
            }

            $this->userRepository->update($userDto, $id);
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
