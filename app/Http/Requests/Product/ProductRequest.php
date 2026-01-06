<?php

namespace App\Http\Requests\Product;

use App\Enums\EUnitFormat;
use App\Http\Dto\Product\ProductDto;
use App\Http\Requests\BaseRequest;
use App\Models\Unit;

class ProductRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'removed_images' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'barcode' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'is_active' => 'required|in:0,1',
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

        $this->normalizeInputs($rules);
        return $rules;
    }

    protected function normalizeInputs(): void
    {
        $this->merge([
            'name' => strtoupper($this->input('name')),
            'price' =>  str_replace(',', '.', $this->input('price')),
            'cost_price' =>  str_replace(',', '.', $this->input('cost_price')),
        ]);
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

            'images.array' => 'As imagens devem ser um array.',
            'images.*.image' => 'O arquivo enviado deve ser uma imagem.',
            'images.*.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg.',
            'images.*.max' => 'A imagem não pode exceder 2MB.',
        ];
    }

    public function getDto()
    {
        return new ProductDto(
            name: (string) $this->input('name'),
            images: $this->file('images') ?? [],
            removedImages: (string) $this->input('removed_images', '[]'),
            description:  (string) $this->input('description'),
            categoryId: (int) $this->input('category_id'),
            unitId: (int) $this->input('unit_id'),
            barcode: (string) $this->input('barcode'),
            price: (float) $this->input('price'),
            costPrice: (float) $this->input('cost_price', 0),
            stockQuantity: (float) $this->input('stock_quantity', 0),
            minQuantity: (float) $this->input('min_quantity', 0),
            isActive: (bool) $this->input('is_active'),
        );
    }
}