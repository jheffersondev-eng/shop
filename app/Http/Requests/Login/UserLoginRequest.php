<?php

namespace App\Http\Requests\Login;

use App\Http\Requests\BaseRequest;

class UserLoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo de email é obrigatório.',
            'email.email' => 'O email fornecido não é válido.',

            'password.required' => 'O campo de senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ];
    }
}