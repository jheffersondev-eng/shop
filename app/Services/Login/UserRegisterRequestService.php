<?php

namespace App\Services\Login;

use App\Http\Dto\User\UserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Repositories\User\IUserRepository;
use App\Repositories\UserDetail\IUserDetailRepository;
use Illuminate\Support\Facades\Hash;

class UserRegisterRequestService implements IUserRegisterRequestService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $userDetailRepository;

    public function __construct(IUserRepository $userRepository, IUserDetailRepository $userDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    public function handler(UserRegisterRequest $userRegisterRequest): UserRegisterRequest
    {
        try {
            $email = strtolower($userRegisterRequest->input('email'));
            $user = $this->userRepository->findByEmail($email);
            
            if ($user) {
                throw new \Exception('Já existe um usuário cadastrado com este e-mail.');
            }

            $password = $userRegisterRequest->request->get('password');
            $passwordConfirmation = $userRegisterRequest->request->get('password_confirmation');

            if (!isset($password) || 
                !isset($passwordConfirmation) || 
                $password !== $passwordConfirmation) {
                    throw new \Exception('A senha e a confirmação de senha não conferem.');
            }

            $userRegisterRequest->request->set('password', Hash::make($password));
            $userRegisterRequest->request->remove('password_confirmation');

            $userDto = new UserDto(
                $userRegisterRequest->input('email'),
                $userRegisterRequest->input('password'),
                $userRegisterRequest->input('profile_id')
            );

            $userDetailsDto = new UserDetailsDto(
                $userRegisterRequest->input('name'),
                $userRegisterRequest->input('document'),
                $userRegisterRequest->input('phone'),
                $userRegisterRequest->input('birth_date'),
                $userRegisterRequest->input('address')
            );

            $this->userRepository->store($userDto);
            $this->userDetailRepository->store($userDetailsDto);

            return $userRegisterRequest;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}