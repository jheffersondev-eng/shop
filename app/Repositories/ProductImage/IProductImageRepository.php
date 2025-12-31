<?php

namespace App\Repositories\ProductImage;

interface IProductImageRepository
{
    public function GetProductImages(int $productId);
}