<?php

namespace App\Repositories\Product;

use App\Http\Dto\Product\FilterDto;
use App\Http\Dto\Product\ProductDto;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function getProductsByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        $query = DB::table('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('units as u', 'p.unit_id', '=', 'u.id')
            ->select(
                    'p.id as id',
                    'p.name',
                    'p.description as description', 
                    'p.image',
                    'p.description',
                    'c.name as category_name',
                    'c.description as category_description',
                    'u.name as unit_name',
                    'u.abbreviation as unit_abbreviation',
                    'u.format as unit_format',
                    'p.barcode',
                    'p.stock_quantity',
                    'p.price',
                    'p.cost_price',
                    'p.min_quantity',
                    'p.is_active',
                    'p.created_at',
                    'p.updated_at'
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters( $query, FilterDto $filterDto)
    {
        $query->where('p.deleted_at', null);

        if($filterDto->id) {
            $query->where('p.id', $filterDto->id);
        }
        
        if($filterDto->dateDe) {
            $query->where('p.created_at', '>=', $filterDto->dateDe);
        }

        if($filterDto->dateAte) {
            $query->where('p.created_at', '<=', $filterDto->dateAte);
        }

        if ($filterDto->name) {
            $query->where('p.name', 'like', "%{$filterDto->name}%");
        }

        if ($filterDto->categoryId) {
            $query->where('p.category_id', $filterDto->categoryId);
        }

        if ($filterDto->unitId) {
            $query->where('p.unit_id', $filterDto->unitId);
        }

        if ($filterDto->barcode) {
            $query->where('p.barcode', 'like', "%{$filterDto->barcode}%");
        }

        if (!is_null($filterDto->isActive)) {
            $query->where('p.is_active', $filterDto->isActive);
        }

        if ($filterDto->stockQuantity) {
            $query->where('p.stock_quantity', '>=', $filterDto->stockQuantity);
        }

        return $query;
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
