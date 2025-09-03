<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserLoginRequest;
use App\Models\User;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserLoginRequestService implements IUserLoginRequestService
{
    public function handler(UserLoginRequest $userLoginRequest)
    {
        try {
            $this->validEmail($userLoginRequest->email);
            $this->validPassword($userLoginRequest);

            $credentials = [
                'email' => $userLoginRequest->email, 
                'password' => $userLoginRequest->password
            ];
            
            Auth::attempt($credentials);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['Não foi possível fazer login' => $e->getMessage()]);
        }
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