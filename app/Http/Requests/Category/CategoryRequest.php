<?php

namespace App\Http\Requests\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->normalizeInputs();

        $rules = [
            'name' => 'required|string|max:50',
        ];

        return $rules;
    }

    protected function normalizeInputs(): void
    {
        $this->merge([
            'name' => strtoupper($this->input('name')),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome deve ter no máximo 50 caracteres.',
        ];
    }

    public function getDto(): CategoryDto
    {
        return new CategoryDto(
            $this->input('name'),
        );
    }
}