<?php

namespace App\Http\Requests\Login;

use App\Http\Dto\User\VerifyDto;
use App\Http\Requests\BaseRequest;

class ViewVerifyRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'email', 'string'],
            'user_id' => ['required', 'string'],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.string' => 'O campo E-mail deve ser um texto.',

            'user_id.required' => 'O campo ID do Usuário é obrigatório.',
            'user_id.string' => 'O campo ID do Usuário deve ser um texto.',
        ];
    }

    public function getDto(): VerifyDto
    {
        return new VerifyDto(
            email: $this->input('email'),
            userId: $this->input('user_id'),
        );
    }
}