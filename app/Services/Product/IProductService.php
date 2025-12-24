<?php

namespace App\Services\Product;

use App\Http\Dto\Product\FilterDto;
use App\Http\Dto\Product\ProductDto;
use App\Models\Product;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductService
{
    public function getProducts(): LengthAwarePaginator;
    public function getProductById(int $id): Product;
    public function getProductsByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function create(ProductDto $productDto): ServiceResult;
    public function update(ProductDto $productDto, int $id): ServiceResult;
    public function delete(int $id): ServiceResult;
}