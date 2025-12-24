<?php

namespace App\Mapper;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Product\ProductAggregateDto;
use App\Http\Dto\Unit\UnitDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class ProductAggregateMapper
{
    public static function map(LengthAwarePaginator $products): LengthAwarePaginator
    {
        $products->getCollection()->transform(function ($product) {
            return new ProductAggregateDto(
                id: $product->id,
                name: $product->name,
                description: $product->description,
                image: $product->image,
                category: new CategoryDto(
                    name: $product->category_name,
                    description: $product->category_description
                ),
                unit: new UnitDto(
                    name: $product->unit_name,
                    abbreviation: $product->unit_abbreviation,
                    format: $product->unit_format
                ),
                barcode: $product->barcode,
                price: $product->price,
                costPrice: $product->cost_price,
                stockQuantity: $product->stock_quantity,
                minQuantity: $product->min_quantity,
                isActive: $product->is_active,
                createdAt: Carbon::parse($product->created_at),
                updatedAt: Carbon::parse($product->updated_at)
            );
        });

        return $products;
    }
}