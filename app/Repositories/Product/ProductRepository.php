<?php

namespace App\Repositories\Product;

use App\Http\Dto\Product\ProductDto;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements IProductRepository
{
    const PAGINATION_SIZE = 10;

    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function getProducts(): LengthAwarePaginator
    {
        return $this->model->paginate(self::PAGINATION_SIZE);
    }

    public function getProductById(int $id): Product
    {
        $product = $this->model->find($id);

        if (!$product) {
            throw new Exception("Produto não encontrado.");
        }

        return $product;
    }

    public function create(ProductDto $productDto)
    {
        $data = [
            'name' => $productDto->name,
            'image' => $productDto->image,
            'description' => $productDto->description,
            'category_id' => $productDto->categoryId,
            'unit_id' => $productDto->unitId,
            'barcode' => $productDto->barcode,
            'price' => $productDto->price,
            'cost_price' => $productDto->costPrice,
            'stock_quantity' => $productDto->stockQuantity,
            'min_quantity' => $productDto->minQuantity,
            'is_active' => $productDto->isActive,
        ];
        
        return $this->model->create($data);
    }

    public function update(ProductDto $productDto, int $id)
    {
        $product = $this->model->find($id);

        if (!$product) {
            throw new Exception("Produto não encontrado.");
        }

        $data = [
            'name' => $productDto->name,
            'image' => $productDto->image,
            'description' => $productDto->description,
            'category_id' => $productDto->categoryId,
            'unit_id' => $productDto->unitId,
            'barcode' => $productDto->barcode,
            'price' => $productDto->price,
            'cost_price' => $productDto->costPrice,
            'stock_quantity' => $productDto->stockQuantity,
            'min_quantity' => $productDto->minQuantity,
            'is_active' => $productDto->isActive,
        ];

        return $product->update($data);
    }

    public function delete(int $id)
    {
        $product = $this->model->find($id);

        if (!$product) {
            throw new Exception("Produto não encontrado.");
        }

        return $product->delete();
    }
}
