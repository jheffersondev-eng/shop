<?php

namespace App\Http\Requests\Profile;

use App\Http\Dto\Profile\FilterDto;
use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class FilterRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'id' => 'nullable|integer|exists:pr,id',
            'name' => 'nullable|string|max:255',
            'date_de' => 'nullable|date',
            'date_ate' => 'nullable|date',
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
            'id.exists' => 'O produto selecionado é inválido.',
            'name.max' => 'O campo nome não pode exceder 255 caracteres.',
            'date_de.date' => 'O campo data de início deve ser uma data válida.',
            'date_ate.date' => 'O campo data de término deve ser uma data válida.',
        ];
    }

    public function getDto()
    {
        return new FilterDto(
            id: $this->input('id'),
            name: $this->input('name'),
            dateDe: $this->input('date_de'),
            dateAte: $this->input('date_ate'),
        );
    }
}