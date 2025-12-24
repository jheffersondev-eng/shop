<?php

namespace App\Http\Requests\Product;

use App\Http\Dto\Product\FilterDto;
use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class FilterRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'id' => 'nullable|integer|exists:products,id',
            'name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'unit_id' => 'nullable|exists:units,id',
            'barcode' => 'nullable|string|max:255',
            'is_active' => 'nullable|in:0,1',
            'stock_quantity' => 'nullable|numeric|min:0',
            'min_quantity' => 'nullable|numeric|min:0',
            'created_at' => 'nullable|date',
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
            'is_active.in' => 'O campo ativo deve ser 0 ou 1.',
            'category_id.exists' => 'A categoria selecionada é inválida.',
            'unit_id.exists' => 'A unidade selecionada é inválida.',
            'barcode.max' => 'O campo código de barras não pode exceder 255 caracteres.',
            'stock_quantity.min' => 'O campo quantidade em estoque não pode ser negativo.',
            'min_quantity.min' => 'O campo quantidade mínima não pode ser negativo.',
            'date_de.date' => 'O campo data de início deve ser uma data válida.',
            'date_ate.date' => 'O campo data de término deve ser uma data válida.',
        ];
    }

    public function getDto()
    {
        return new FilterDto(
            id: $this->input('id'),
            name: $this->input('name'),
            categoryId: $this->input('category_id'),
            unitId: $this->input('unit_id'),
            barcode: $this->input('barcode'),
            stockQuantity: $this->input('stock_quantity', 0),
            minQuantity: $this->input('min_quantity', 0),
            isActive: $this->input('is_active'),
            dateDe: $this->input('date_de'),
            dateAte: $this->input('date_ate'),
        );
    }
}