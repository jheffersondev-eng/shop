<?php

namespace App\Services\User;

use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Http\Requests\User\CreateUserRequest;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Hash;

class CreateUserRequestService implements ICreateUserRequestService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $userDetailRepository;

    public function __construct(IUserRepository $userRepository, IUserDetailRepository $userDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    public function handler(CreateUserRequest $createUserRequest): CreateUserRequest
    {
        $this->validatePassword($createUserRequest);

        $userDto = new CreateUserDto(
            $createUserRequest->input('email'),
            $createUserRequest->input('password')
        );

        $userDto->setUserIdCreate($createUserRequest->input('user_id_create'));
        $user = $this->userRepository->store($userDto);

        $userDetailDto = new UserDetailsDto(
            $createUserRequest->input('name'),
            $createUserRequest->input('document'),
            $createUserRequest->input('phone'),
            $createUserRequest->input('birth_date'),
            $createUserRequest->input('address')
        );

        $userDetailDto->setUserId($user->id);
        $this->userDetailRepository->store($userDetailDto);

        return $createUserRequest;
    }

    public function validatePassword(CreateUserRequest $createUserRequest): void
    {
        $password = $createUserRequest->input('password');
        $passwordConfirmation = $createUserRequest->input('password_confirmation');

        if (empty($password) && empty($passwordConfirmation)) {
            return;
        }

        if (!isset($password) || !isset($passwordConfirmation) || $password !== $passwordConfirmation) {
            throw new \Exception('A senha e a confirmação de senha não conferem.');
        }

        $createUserRequest->merge(['password' => Hash::make($password)]);
        if ($createUserRequest->request->has('password_confirmation')) {
            $createUserRequest->request->remove('password_confirmation');
        }
    }
}