<?php

namespace App\Http\Requests\Login;

use App\Http\Dto\User\ResendVerifyEmailDto;
use App\Http\Requests\BaseRequest;

class ResendVerifyEmailRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'string', 'email'],
            'user_id' => ['required', 'string'],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.string' => 'O campo E-mail deve ser um texto.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',

            'user_id.required' => 'O campo ID do Usuário é obrigatório.',
            'user_id.string' => 'O campo ID do Usuário deve ser um texto.',
        ];
    }

    public function getDto(): ResendVerifyEmailDto
    {
        return new ResendVerifyEmailDto(
            email: $this->input('email'),
            userId: $this->input('user_id'),
        );
    }
}
