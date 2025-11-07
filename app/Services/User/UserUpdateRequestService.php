<?php

namespace App\Services\User;

use App\Http\Dto\UserDetail\CreateClientDto;
use App\Http\Dto\User\UpdateUserDto;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserUpdateRequestService implements IUserUpdateRequestService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $clientRepository;

    public function __construct(IUserRepository $userRepository, IUserDetailRepository $clientRepository)
    {
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
    }

    public function handler(UserUpdateRequest $userUpdateRequest)
    {
        try {
            // validate and hash password if provided
            $this->validatePassword($userUpdateRequest);

            $userDto = new UpdateUserDto(
                $userUpdateRequest->input('id'),
                $userUpdateRequest->input('email'),
                $userUpdateRequest->input('password')
            );

            $this->userRepository->updateUserWithDto($userDto);

            // build client/user-detail dto and upsert
            $clientDto = new CreateClientDto(
                $userUpdateRequest->input('name'),
                $userUpdateRequest->input('document'),
                $userUpdateRequest->input('phone'),
                $userUpdateRequest->input('birth_date'),
                $userUpdateRequest->input('address'),
                (int)$userUpdateRequest->input('id')
            );

            $updated = $this->clientRepository->updateClientWithDto($clientDto);
            if (! $updated) {
                $this->clientRepository->store($clientDto);
            }

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