<?php

namespace App\Services\User;

use App\Http\Dto\User\UpdateUserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\UserDetail\IUserDetailRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequestService implements IUpdateUserRequestService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $userDetailRepository;

    public function __construct(IUserRepository $userRepository, IUserDetailRepository $userDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    public function handler(UpdateUserRequest $updateUserRequest)
    {
        try {
            $this->validatePassword($updateUserRequest);

            $userDto = new UpdateUserDto(
                $updateUserRequest->input('id'),
                $updateUserRequest->input('email'),
                $updateUserRequest->input('password')
            );

            $userDto->setUpdatedBy($updateUserRequest->input('updated_by'));

            $userDetailDto = new UserDetailsDto(
                $updateUserRequest->input('name'),
                $updateUserRequest->input('document'),
                $updateUserRequest->input('phone'),
                $updateUserRequest->input('birth_date'),
                $updateUserRequest->input('address'),
                $updateUserRequest->input('id')
            );

            $this->userRepository->update($userDto);
            $this->userDetailRepository->update($userDetailDto);

            return true;
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['' => $e->getMessage()]);
        }
    }

    public function validatePassword(UpdateUserRequest $updateUserRequest): void
    {
        $password = $updateUserRequest->input('password');
        $passwordConfirmation = $updateUserRequest->input('password_confirmation');

        if (empty($password) && empty($passwordConfirmation)) {
            return;
        }

        if (!isset($password) || !isset($passwordConfirmation) || $password !== $passwordConfirmation) {
            throw new \Exception('A senha e a confirmação de senha não conferem.');
        }

        $updateUserRequest->merge(['password' => Hash::make($password)]);
        if ($updateUserRequest->request->has('password_confirmation')) {
            $updateUserRequest->request->remove('password_confirmation');
        }
    }
}