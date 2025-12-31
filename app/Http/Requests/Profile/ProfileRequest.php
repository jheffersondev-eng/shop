<?php

namespace App\Http\Requests\Profile;

use App\Http\Dto\Profile\ProfileDto;
use App\Http\Requests\BaseRequest;

class ProfileRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'permissions' => 'required|string',
        ];

        $this->normalizeInputs();

        return $rules;
    }

    protected function normalizeInputs(): void
    {
        $this->merge([
            'name' => strtoupper($this->input('name')),
            'permissions' => implode(',', $this->input('permissions')),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome deve ter no máximo 50 caracteres.',
            'description.string' => 'O campo Descrição deve ser um texto.',
            'description.max' => 'O campo Descrição deve ter no máximo 255 caracteres.',
            'permissions.required' => 'O campo Permissões é obrigatório.',
            'permissions.string' => 'O campo Permissões deve ser um texto.',
        ];
    }

    public function getDto(): ProfileDto
    {
        return new ProfileDto(
            $this->input('name'),
            $this->input('description', null),
            $this->input('permissions'),
        );
    }
}