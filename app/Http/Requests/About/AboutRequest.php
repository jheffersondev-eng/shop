<?php

namespace App\Http\Requests\About;

use App\Http\Dto\About\SendEmailDto;
use App\Traits\ReCaptcha;

class AboutRequest
{
    use ReCaptcha;
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser uma string.',
            'name.max' => 'O campo Nome deve ter no máximo 50 caracteres.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.string' => 'O campo E-mail deve ser uma string.',
            'email.max' => 'O campo E-mail deve ter no máximo 255 caracteres.',
            'subject.required' => 'O campo Assunto é obrigatório.',
            'subject.string' => 'O campo Assunto deve ser uma string.',
            'subject.max' => 'O campo Assunto deve ter no máximo 100 caracteres.',
            'message.required' => 'O campo Mensagem é obrigatório.',
            'message.string' => 'O campo Mensagem deve ser uma string.',
            'message.max' => 'O campo Mensagem deve ter no máximo 1000 caracteres.',
        ];
    }

    public function getDto(): SendEmailDto
    {
        return new SendEmailDto(
            name: request()->input('name'),
            email: request()->input('email'),
            subject: request()->input('subject'),
            message: request()->input('message'),
        );
    }
}