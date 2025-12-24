<?php

namespace App\Repositories\Product;

use App\Http\Dto\Product\FilterDto;
use App\Http\Dto\Product\ProductDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductRepository
{
    public function getProducts(): LengthAwarePaginator;
    public function getProductById(int $id): Product;
    public function getProductsByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function create(ProductDto $productDto);
    public function update(ProductDto $productDto, int $id);
    public function delete(int $id);
}