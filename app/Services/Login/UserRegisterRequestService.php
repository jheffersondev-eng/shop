<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserRegisterService implements IUserRegisterService
{
    public function handler(UserRegisterRequest $userRegisterRequest)
    {
        $password = $userRegisterRequest->request->get('password');
        $passwordConfirmation = $userRegisterRequest->request->get('password_confirmation');

        if (!isset($password) || 
            !isset($passwordConfirmation) || 
            $password !== $passwordConfirmation) {
                throw new \Exception('A senha e a confirmação de senha não conferem.');
        }

        $userRegisterRequest->request->set('password', Hash::make($password));
        $userRegisterRequest->request->remove('password_confirmation');

        return $userRegisterRequest;
    }
}