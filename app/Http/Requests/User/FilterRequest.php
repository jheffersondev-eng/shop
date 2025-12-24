<?php

namespace App\Http\Requests\User;

use App\Http\Dto\User\FilterDto;
use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class FilterRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'id' => 'nullable|integer|exists:users,id',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'profile_id' => 'nullable|exists:profiles,id',
            'is_active' => 'nullable|in:0,1',
            'data_de' => 'nullable|date',
            'data_ate' => 'nullable|date',
        ];

        $this->normalizeInputs();

        return $rules;
    }

    protected function normalizeInputs(): void
    {
        $this->merge([
            'date_de' => $this->input('date_de') ? Carbon::parse($this->input('date_de')) : null,
            'date_ate' => $this->input('date_ate') ? Carbon::parse($this->input('date_ate')) : null,
        ]);
    }

    public function messages(): array
    {
        return [
            'id.exists' => 'O usuário selecionado é inválido.',
            'name.max' => 'O campo nome não pode exceder 255 caracteres.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode exceder 255 caracteres.',
            'profile_id.exists' => 'O perfil selecionado é inválido.',
            'is_active.in' => 'O campo ativo deve ser 0 ou 1.',
            'data_de.date' => 'O campo data de deve ser uma data válida.',
            'data_ate.date' => 'O campo data até deve ser uma data válida.',
        ];
    }
    
    public function getDto()
    {
        return new FilterDto(
            id: $this->input('id'),
            name: $this->input('name'),
            email: $this->input('email'),
            profileId: $this->input('profile_id'),
            isActive: $this->input('is_active'),
            dateDe: $this->input('date_de'),
            dateAte: $this->input('date_ate'),
        );
    }
}