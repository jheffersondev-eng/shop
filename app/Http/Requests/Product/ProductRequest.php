<?php

namespace App\Http\Requests\Product;

use App\Enums\EUnitFormat;
use App\Http\Requests\BaseRequest;
use App\Models\Unit;

class ProductRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // Verificar o formato da unidade selecionada
        $unitId = $this->input('unit_id');
        if ($unitId) {
            $unit = Unit::find($unitId);
            if ($unit) {
                if ($unit->format == EUnitFormat::INTEGER) {
                    $rules['stock_quantity'] = 'required|integer|min:0';
                    $rules['min_quantity'] = 'nullable|integer|min:0';
                } else {
                    $rules['stock_quantity'] = 'required|numeric|min:0';
                    $rules['min_quantity'] = 'nullable|numeric|min:0';
                }
            }
        } else {
            // Valor padrão se nenhuma unidade for selecionada
            $rules['stock_quantity'] = 'required|numeric|min:0';
            $rules['min_quantity'] = 'nullable|numeric|min:0';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome não pode exceder 255 caracteres.',

            'category_id.required' => 'O campo categoria é obrigatório.',
            'category_id.exists' => 'A categoria selecionada é inválida.',

            'unit_id.required' => 'O campo unidade é obrigatório.',
            'unit_id.exists' => 'A unidade selecionada é inválida.',

            'price.required' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O campo preço deve ser um número.',
            'price.min' => 'O campo preço não pode ser negativo.',

            'cost_price.numeric' => 'O campo preço de custo deve ser um número.',
            'cost_price.min' => 'O campo preço de custo não pode ser negativo.',

            'stock_quantity.required' => 'O campo quantidade em estoque é obrigatório.',
            'stock_quantity.integer' => 'O campo quantidade em estoque deve ser um número inteiro.',
            'stock_quantity.numeric' => 'O campo quantidade em estoque deve ser um número.',
            'stock_quantity.min' => 'O campo quantidade em estoque não pode ser negativo.',

            'min_quantity.integer' => 'O campo quantidade mínima deve ser um número inteiro.',
            'min_quantity.numeric' => 'O campo quantidade mínima deve ser um número.',
            'min_quantity.min' => 'O campo quantidade mínima não pode ser negativo.',

            'image.image' => 'O arquivo enviado deve ser uma imagem.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg.',
            'image.max' => 'A imagem não pode exceder 2MB.',
        ];
    }
}