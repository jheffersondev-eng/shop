<?php

namespace App\Services\Product;

use App\Http\Dto\Product\ProductDto;
use App\Models\Product;
use App\Repositories\Product\IProductRepository;
use App\Services\ServiceResult;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductService implements IProductService
{
    protected IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(): LengthAwarePaginator
    {
        return $this->productRepository->getProducts();
    }

    public function getProductById(int $id): Product
    {
        return $this->productRepository->getProductById($id);
    }

    private function deleteOldImage(Product $product): void
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
    }

    public function create(ProductDto $productDto): ServiceResult
    {
        try {
            if ($productDto->image instanceof UploadedFile) {
                $productDto->image = $productDto->image->store('products', 'public');
            }

            $product = $this->productRepository->create($productDto);

            return ServiceResult::ok(
                data: $product,
                message: 'Produto criado com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao criar produto: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar produto');
        }
    }

    public function update(ProductDto $productDto, int $id): ServiceResult
    {
        try {
            $product = $this->getProductById($id);

            if ($productDto->image instanceof UploadedFile) {
                $this->deleteOldImage($product);
                $productDto->image = $productDto->image->store('products', 'public');
            }
            
            $this->productRepository->update($productDto, $id);

            return ServiceResult::ok(
                message: 'Produto atualizado com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao atualizar produto: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao atualizar produto');
        }
    }

    public function delete(int $id): ServiceResult
    {
        try {
            $this->productRepository->delete($id);

            return ServiceResult::ok(
                message: 'Produto removido com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao remover produto: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao remover produto');
        }
    }
}