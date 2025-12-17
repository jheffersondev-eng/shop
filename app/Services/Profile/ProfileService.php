<?php

namespace App\Services\Profile;

use App\Http\Dto\Profile\ProfileDto;
use App\Models\Profile;
use App\Repositories\Profile\IProfileRepository;
use App\Services\ServiceResult;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileService implements IProfileService
{
    protected IProfileRepository $profileRepository;

    public function __construct(IProfileRepository $profileRepository) 
    {
        $this->profileRepository = $profileRepository;
    }

    public function getProfiles(): LengthAwarePaginator
    {
        return $this->profileRepository->getProfiles();
    }

    public function getProfileById(int $id): Profile
    {
        return $this->profileRepository->getProfileById($id);
    }

    public function create(ProfileDto $profileDto): ServiceResult
    {
        try {
            $profile = $this->profileRepository->create($profileDto);

            return ServiceResult::ok(
                data: $profile,
                message: 'Perfil criado com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao criar perfil: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar perfil');
        }
    }
    
    public function update(ProfileDto $profileDto, int $id): ServiceResult
    {
        try {
            $this->profileRepository->update($id, $profileDto);
    
            return ServiceResult::ok(
                message: 'Perfil atualizado com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao atualizar perfil: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao atualizar perfil');
        }
    }
    
    public function delete(int $id): ServiceResult
    {
        try {
            $this->profileRepository->delete($id);

            return ServiceResult::ok(
                message: 'Perfil removido com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao remover perfil: '.$e->getMessage());
            return ServiceResult::fail('Erro ao remover perfil');
        }
    }
}
