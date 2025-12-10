<?php

namespace App\Services\Product;
use App\Http\Requests\Product\ProductRequest;
use App\Repositories\Product\IProductRepository;

class ProductRequestService implements IProductRequestService
{
    protected IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handler(ProductRequest $productRequest): ProductRequest
    {
        try {
            $data = $productRequest->all();
            
            if ($productRequest->hasFile('image') && $productRequest->file('image')->isValid()) {
                $path = $productRequest->file('image')->store('products', 'public');
                $data['image'] = $path;
            }

            $this->productRepository->store($data);

            return $productRequest;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}