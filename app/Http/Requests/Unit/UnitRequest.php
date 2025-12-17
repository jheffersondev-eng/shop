<?php

namespace App\Http\Requests\Unit;

use App\Http\Dto\Unit\UnitDto;
use App\Http\Requests\BaseRequest;

class UnitRequest extends BaseRequest
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
            'abbreviation' => 'required|string|max:5',
            'format' => 'required|integer',
        ];

        return $rules;
    }

    protected function normalizeInputs(): void
    {
        $this->merge([
            'name' => strtoupper($this->input('name')),
            'format' => $this->input('format'),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome deve ter no máximo 50 caracteres.',

            'abbreviation.required' => 'O campo Abreviação é obrigatório.',
            'abbreviation.string' => 'O campo Abreviação deve ser um texto.',
            'abbreviation.max' => 'O campo Abreviação deve ter no máximo 5 caracteres.',

            'format.required' => 'O campo Formato é obrigatório.',
            'format.integer' => 'O campo Formato deve ser um número inteiro.',
        ];
    }

    public function getDto(): UnitDto
    {
        return new UnitDto(
            $this->input('name'),
            $this->input('abbreviation'),
            $this->input('format'),
        );
    }
}