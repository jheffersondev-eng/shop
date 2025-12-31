<?php

namespace App\Services\Product;

use App\Http\Dto\Product\FilterDto;
use App\Http\Dto\Product\ProductDto;
use App\Mapper\ProductAggregateMapper;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\Product\IProductRepository;
use App\Services\ProductImage\IProductImageService;
use App\Services\ServiceResult;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\DB;

class ProductService implements IProductService
{
    protected IProductRepository $productRepository;
    protected ProductAggregateMapper $productAggregateMapper;
    protected IProductImageService $productImageService;

    public function __construct(
        IProductRepository $productRepository,
        ProductAggregateMapper $productAggregateMapper,
        IProductImageService $productImageService
    )
    {
        $this->productRepository = $productRepository;
        $this->productAggregateMapper = $productAggregateMapper;
        $this->productImageService = $productImageService;
    }

    public function getProducts(): LengthAwarePaginator
    {
        try {
            $products = $this->productRepository->getProducts();
            $productsAggregate = $this->productAggregateMapper->map($products);
            
            return $productsAggregate;

        } catch (Throwable $e) {
            Log::error('Erro ao listar produtos: '.$e->getMessage());
            throw $e;
        }
    }

    public function getProductById(int $id): Product
    {
        try {
            $product = $this->productRepository->getProductById($id);
            return $product;

        } catch (Throwable $e) {
            Log::error('Erro ao obter produto por ID: '.$e->getMessage());
            throw $e;
        }
    }

    public function getProductsByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        try {
            $products = $this->productRepository->getProductsByFilter($filterDto);
            $productsAggregate = $this->productAggregateMapper->map($products);
            
            return $productsAggregate;
        } catch (Throwable $e) {
            Log::error('Erro ao filtrar produtos: '.$e->getMessage());
            throw $e;
        }
    }

    private function deleteOldImage(string|null $image): void
    {
        if ($image && Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    private function removeDeletedImages(string $removedImagesJson): void
    {
        try {
            $removedImages = json_decode($removedImagesJson, true) ?? [];
            
            foreach ($removedImages as $imageId) {
                $productImage = ProductImage::find($imageId);
                if ($productImage) {
                    $this->deleteOldImage($productImage->image);
                    $productImage->delete();
                }
            }
        } catch (Throwable $e) {
            Log::warning('Erro ao remover imagens deletadas: '.$e->getMessage());
        }
    }

    private function storeProductImages(int $productId, array $images): void
    {
        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $productId,
                    'image' => $imagePath,
                ]);
            }
        }
    }

    public function create(ProductDto $productDto): ServiceResult
    {
        try {
            DB::beginTransaction();

            $product = $this->productRepository->create($productDto);

            if (!empty($productDto->images)) {
                $this->storeProductImages($product->id, $productDto->images);
            }

            DB::commit();

            return ServiceResult::ok(
                data: $product,
                message: 'Produto criado com sucesso'
            );

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao criar produto: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar produto');
        }
    }

    public function update(ProductDto $productDto, int $id): ServiceResult
    {
        try {
            DB::beginTransaction();

            if ($productDto->removedImages) {
                $this->removeDeletedImages($productDto->removedImages);
            }

            if (!empty($productDto->images)) {
                $this->storeProductImages($id, $productDto->images);
            }

            $this->productRepository->update($productDto, $id);

            DB::commit();

            return ServiceResult::ok(
                message: 'Produto atualizado com sucesso'
            );

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar produto: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao atualizar produto');
        }
    }

    public function delete(int $id): ServiceResult
    {
        try {
            DB::beginTransaction();

            ProductImage::where('product_id', $id)->get()->each(function ($image) {
                $this->deleteOldImage($image->image);
                $image->delete();
            });

            $this->productRepository->delete($id);

            DB::commit();

            return ServiceResult::ok(
                message: 'Produto removido com sucesso'
            );

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao remover produto: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao remover produto');
        }
    }
}