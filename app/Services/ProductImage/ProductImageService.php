<?php

namespace App\Services\ProductImage;

use App\Repositories\ProductImage\IProductImageRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductImageService implements IProductImageService
{
    protected IProductImageRepository $productImageRepository;

    public function __construct(IProductImageRepository $productImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
    }

    public function getProductImages(int $productId): Collection
    {
        try {
            return $this->productImageRepository->GetProductImages($productId);

        } catch (Throwable $e) {
            Log::error('Erro ao retornar imagens: '.$e->getMessage());
            throw $e;
        }
    }
}