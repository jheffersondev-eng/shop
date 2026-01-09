<?php

namespace App\Services\User;

use App\Helpers\TimeHelper;
use App\Http\Dto\User\FilterDto;
use App\Http\Dto\User\ResendVerifyEmailDto;
use App\Http\Dto\User\UserDto;
use App\Http\Dto\User\VerifyEmailDto;
use App\Mail\SendMail;
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
            $userDto->ownerId = Auth::id() ?? null;

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
                        
            if (!$user->owner_id) {
                $user->owner_id = $user->id;
            }
            
            $verificationCode = $this->generateVerificationCode();
            $user->verification_code = $verificationCode;
            $user->verification_expires_at = now()->addMinutes(30);
            
            $this->userRepository->save($user);
            $userDto->userDetailsDto->userId = $user->id;
            $this->userDetailRepository->create($userDto->userDetailsDto);

            SendMail::send($user->email, $user, $verificationCode);

            return ServiceResult::ok(
                data: $user,
                message: 'Usuário criado com sucesso',
                route: route('register.verify-email-view', ['user_id' => $user->id, 'email' => $user->email])
            );

        } catch (Throwable $e) {
            Log::error('Erro ao criar usuário: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());
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

    public function verifyEmail(VerifyEmailDto $verifyEmailDto): ServiceResult
    {
        try {
            $user = $this->userRepository->getUserById($verifyEmailDto->userId);

            if (!$user) {
                return ServiceResult::fail('Usuário não encontrado');
            }

            if (!$user || $user->verification_code !== $verifyEmailDto->verificationCode) {
                return ServiceResult::fail('Código de verificação inválido');
            }

            if ($user->verification_expires_at < now()) {
                return ServiceResult::fail('Código de verificação expirado');
            }

            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->verification_expires_at = null;

            $this->userRepository->save($user);

            return ServiceResult::ok(
                message: 'Email verificado com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao verificar email: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao verificar o email');
        }
    }

    public function resendVerificationEmail(ResendVerifyEmailDto $resendVerifyEmailDto): ServiceResult
    {
        try {
            $user = $this->userRepository->getUserById($resendVerifyEmailDto->userId);

            if (!$user) {
                return ServiceResult::fail('Usuário não encontrado');
            }

            if($user->email_verified_at !== null) {
                return ServiceResult::fail('Email já verificado');
            }
            
            // Verifica se já se passaram 5 minutos desde o último envio
            $lastSend = $user->verification_expires_at->subMinutes(30);
            $currentTime = $lastSend->diffInMinutes(now());
            $minutesRemaining = 5 - $currentTime;

            if($currentTime < 5) {
                $timeFormatted = TimeHelper::formatMinutesAndSeconds($minutesRemaining);
                return ServiceResult::fail("Aguarde {$timeFormatted} antes de reenviar o código de verificação");
            }

            $verificationCode = $this->generateVerificationCode();
            $user->verification_code = $verificationCode;
            $user->verification_expires_at = now()->addMinutes(30);

            $this->userRepository->save($user);

            SendMail::send($user->email, $user, $verificationCode);

            return ServiceResult::ok(
                data: null,
                message: 'Email de verificação reenviado com sucesso',
                route: route('register.verify-email-view', ['user_id' => $user->id, 'email' => $user->email])
            );
        } catch (Throwable $e) {
            Log::error('Erro ao reenviar email de verificação: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao reenviar o email de verificação');
        }
    }

    private function generateVerificationCode(): int
    {
        return rand(100000, 999999);
    }
}
