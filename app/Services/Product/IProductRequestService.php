<?php

namespace App\Services\Product;

use App\Http\Requests\Product\ProductRequest;

interface IProductRequestService
{
    public function handler(ProductRequest $productRequest);
}