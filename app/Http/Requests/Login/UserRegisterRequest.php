<?php

namespace App\Http\Requests\Login;

use App\Enums\EProfile;
use App\Helpers\DocumentHelper;
use App\Helpers\PhoneHelper;
use App\Http\Requests\BaseRequest;

class UserRegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        if (!$this->input('profile_id')) {
            $this->merge(['profile_id' => EProfile::ADMIN->value]);
        }

        $this->merge([
            'email' => strtolower($this->input('email')),
            'document' => DocumentHelper::stripSpecialChars($this->input('document')),
            'phone' => PhoneHelper::normalize($this->input('phone')),
            'address' => strtolower($this->input('address')),
            'name' => strtoupper($this->input('name')),
        ]);

        return [
            'name' => ['required', 'string', 'max:200'],
            'profile_id' => ['required', 'integer'],
            'email' => ['required', 'email', 'max:200'],
            'document' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome deve ter no máximo 200 caracteres.',

            'profile_id.required' => 'O campo Perfil é obrigatório.',
            'profile_id.integer' => 'O campo Perfil deve ser um número inteiro.',

            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.max' => 'O campo E-mail deve ter no máximo 200 caracteres.',

            'document.required' => 'O campo Documento é obrigatório.',
            'document.string' => 'O campo Documento deve ser um texto.',
            'document.max' => 'O campo Documento deve ter no máximo 20 caracteres.',

            'phone.required' => 'O campo Telefone é obrigatório.',
            'phone.string' => 'O campo Telefone deve ser um texto.',
            'phone.max' => 'O campo Telefone deve ter no máximo 20 caracteres.',

            'birth_date.required' => 'O campo Data de Nascimento é obrigatório.',
            'birth_date.date' => 'Informe uma data de nascimento válida.',

            'address.required' => 'O campo Endereço é obrigatório.',
            'address.string' => 'O campo Endereço deve ser um texto.',
            'address.max' => 'O campo Endereço deve ter no máximo 255 caracteres.',

            'password.required' => 'O campo Senha é obrigatório.',
            'password.string' => 'O campo Senha deve ser um texto.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ];
    }
}
