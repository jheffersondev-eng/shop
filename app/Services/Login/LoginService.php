<?php

namespace App\Services\Login;

use App\Http\Requests\Login\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\ServiceResult;
use Throwable;

class LoginService implements ILoginService
{
    public function handler(UserLoginRequest $userLoginRequest): ServiceResult
    {
        try {
            $credentials = [
                'email' => $userLoginRequest->email,
                'password' => $userLoginRequest->password
            ];
            
            if (!Auth::attempt($credentials)) {
                return ServiceResult::fail('E-mail ou senha incorretos');
            }

            // Verifica se o email foi verificado
            $user = Auth::user();
            if ($user->email_verified_at === null) {
                Auth::logout();
                return ServiceResult::ok(
                    data: $user,
                    message: 'Por favor, verifique seu email antes de fazer login. Verifique o código de confirmação que foi enviado para seu email.',
                    route: route('register.verify-email-view', ['user_id' => $user->id, 'email' => $user->email])
                );
            }

            return ServiceResult::ok(
                data: null, 
                message: 'Login realizado com sucesso',
                route: route('dashboard')
            );
        } catch (Throwable $e) {
            return ServiceResult::fail('Erro ao realizar login: ' . $e->getMessage());
        }
    }
}