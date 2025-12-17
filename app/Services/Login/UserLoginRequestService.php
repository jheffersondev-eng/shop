<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserLoginRequest;
use App\Models\User;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Services\ServiceResult;

class UserLoginRequestService implements IUserLoginRequestService
{
    public function handler(UserLoginRequest $userLoginRequest)
    {
        $credentials = [
            'email' => $userLoginRequest->email,
            'password' => $userLoginRequest->password
        ];
        
        if (!Auth::attempt($credentials)) {
            return ServiceResult::fail('E-mail ou senha incorretos');
        }

        return ServiceResult::ok(null, 'Login realizado com sucesso');
    }

    private function validEmail(string $email): void
    {
        $user = User::where('email', $email)->first();

        if ($user === null) {
            throw new \Exception("Email não encontrado: $email");
        }
    }

    private function validPassword(UserLoginRequest $userLoginRequest): void
    {
        $user = User::where('email', $userLoginRequest->email)
                    ->first();
        
        if (!Hash::check($userLoginRequest->password, $user->password)) {
            throw new \Exception("E-mail ou Senha incorreta.");
        }
    }
}