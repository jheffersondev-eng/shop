<?php

namespace App\Services\Product;

use App\Http\Requests\Product\ProductUpdateRequest;
use App\Repositories\Product\IProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductUpdateRequestService implements IProductUpdateRequestService
{
    protected IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handler(ProductUpdateRequest $productUpdateRequest): ProductUpdateRequest
    {
        try {
            $data = $productUpdateRequest->all();
            
            if ($productUpdateRequest->hasFile('image') && $productUpdateRequest->file('image')->isValid()) {
                // Buscar produto para pegar imagem antiga
                $product = $this->productRepository->findWithoutTrashed($productUpdateRequest->id);
                
                // Excluir imagem antiga se existir
                if ($product && $product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                
                // Salvar nova imagem
                $path = $productUpdateRequest->file('image')->store('products', 'public');
                $data['image'] = $path;
            }
            
            $this->productRepository->updateProduct($productUpdateRequest->id, $data);
            return $productUpdateRequest;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}