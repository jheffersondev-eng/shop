<?php

namespace App\Services\User;

use App\Http\Dto\User\UpdateUserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserUpdateRequestService implements IUserUpdateRequestService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $userDetailRepository;

    public function __construct(IUserRepository $userRepository, IUserDetailRepository $userDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    public function handler(UserUpdateRequest $userUpdateRequest)
    {
        try {
            $this->validatePassword($userUpdateRequest);

            $userDto = new UpdateUserDto(
                $userUpdateRequest->input('id'),
                $userUpdateRequest->input('email'),
                $userUpdateRequest->input('password')
            );

            $userDetailDto = new UserDetailsDto(
                $userUpdateRequest->input('name'),
                $userUpdateRequest->input('document'),
                $userUpdateRequest->input('phone'),
                $userUpdateRequest->input('birth_date'),
                $userUpdateRequest->input('address'),
                $userUpdateRequest->input('id')
            );

            $this->userRepository->update($userDto);
            $this->userDetailRepository->update($userDetailDto);

            return true;
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['' => $e->getMessage()]);
        }
    }

    public function validatePassword(UserUpdateRequest $userUpdateRequest): void
    {
        $password = $userUpdateRequest->input('password');
        $passwordConfirmation = $userUpdateRequest->input('password_confirmation');

        // if password not provided, nothing to do
        if (empty($password) && empty($passwordConfirmation)) {
            return;
        }

        if (!isset($password) || !isset($passwordConfirmation) || $password !== $passwordConfirmation) {
            throw new \Exception('A senha e a confirmação de senha não conferem.');
        }

        $userUpdateRequest->merge(['password' => Hash::make($password)]);
        // remove confirmation so it doesn't pollute DTOs
        if ($userUpdateRequest->request->has('password_confirmation')) {
            $userUpdateRequest->request->remove('password_confirmation');
        }
    }
}