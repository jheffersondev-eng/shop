<?php

namespace App\Services\ProductImage;

use Illuminate\Support\Collection;

interface IProductImageService
{
    public function getProductImages(int $productId): Collection;
}