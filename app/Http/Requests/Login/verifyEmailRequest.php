<?php

namespace App\Http\Requests\Login;

use App\Http\Dto\User\VerifyEmailDto;
use App\Http\Requests\BaseRequest;

class VerifyEmailRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'verification_code' => ['required', 'string'],
            'user_id' => ['required', 'string'],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'verification_code.required' => 'O campo Código de Verificação é obrigatório.',
            'verification_code.string' => 'O campo Código de Verificação deve ser um texto.',

            'user_id.required' => 'O campo ID do Usuário é obrigatório.',
            'user_id.string' => 'O campo ID do Usuário deve ser um texto.',
        ];
    }

    public function getDto(): VerifyEmailDto
    {
        return new VerifyEmailDto(
            verificationCode: $this->input('verification_code'),
            userId: $this->input('user_id'),
        );
    }
}
