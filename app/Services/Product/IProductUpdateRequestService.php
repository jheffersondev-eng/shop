<?php

namespace App\Services\Product;

use App\Http\Requests\Product\ProductUpdateRequest;

interface IProductUpdateRequestService
{
    public function handler(ProductUpdateRequest $productUpdateRequest): ProductUpdateRequest;
}