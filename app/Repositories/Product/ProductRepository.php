<?php

namespace App\Repositories\Product;

use App\Http\Dto\Product\FilterDto;
use App\Http\Dto\Product\ProductDto;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductRepository extends BaseRepository implements IProductRepository
{
    const PAGINATION_SIZE = 10;
    protected int $userLoggedId;
    protected int $ownerId;
    
    public function __construct()
    {
        parent::__construct(new Product());
        $this->userLoggedId = Auth::id();
        $this->ownerId = Auth::user()->owner_id;
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
            ->leftJoin('users as uc', 'p.user_id_created', '=', 'uc.id')
            ->leftJoin('user_details as udc', 'uc.id', '=', 'udc.user_id')
            ->leftJoin('users as uu', 'p.user_id_updated', '=', 'uu.id')
            ->leftJoin('user_details as udu', 'uu.id', '=', 'udu.user_id')
            ->select(
                    'p.id as id',
                    'p.name',
                    'p.description as description',
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
                    'udc.name as user_created_name',
                    'udu.name as user_updated_name',
                    'p.created_at',
                    'p.updated_at',
                    'p.deleted_at'
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, FilterDto $filterDto)
    {
        $query->whereNull('p.deleted_at')
            ->where(function($q) {
                $q->where('p.user_id_created', '=', $this->userLoggedId)
                    ->orWhere('p.owner_id', '=', $this->ownerId);
            });

        $query->whereNull('p.deleted_at');

        if($filterDto->id) {
            $query->where('p.id', $filterDto->id);
        }
        
        if($filterDto->dateDe) {
            $query->whereDate('p.created_at', '>=', $filterDto->dateDe);
        }
        
        if($filterDto->dateAte) {
            $query->whereDate('p.created_at', '<=', $filterDto->dateAte);
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

    public function create(ProductDto $productDto): Product
    {
        $data = [
            'name' => $productDto->name,
            'description' => $productDto->description,
            'category_id' => $productDto->categoryId,
            'unit_id' => $productDto->unitId,
            'barcode' => $productDto->barcode,
            'price' => $productDto->price,
            'cost_price' => $productDto->costPrice,
            'stock_quantity' => $productDto->stockQuantity,
            'min_quantity' => $productDto->minQuantity,
            'is_active' => $productDto->isActive,
            'user_id_created' => $this->userLoggedId,
            'owner_id' => $this->ownerId,
        ];
        
        $product = $this->model->create($data);

        if (!empty($productDto->images)) {
            $this->storeProductImages($product->id, $productDto->images);
        }

        return $product;
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

    private function deleteOldImage(string|null $image): void
    {
        if ($image && Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function update(ProductDto $productDto, int $id): bool
    {
        $product = $this->model->find($id);

        if (!$product) {
            throw new Exception("Produto não encontrado.");
        }

        if ($productDto->removedImages) {
            $this->removeDeletedImages($product->removedImages);
        }

        if (!empty($productDto->images)) {
            $this->storeProductImages($id, $productDto->images);
        }

        $data = [   
            'name' => $productDto->name,
            'description' => $productDto->description,
            'category_id' => $productDto->categoryId,
            'unit_id' => $productDto->unitId,
            'barcode' => $productDto->barcode,
            'price' => $productDto->price,
            'cost_price' => $productDto->costPrice,
            'stock_quantity' => $productDto->stockQuantity,
            'min_quantity' => $productDto->minQuantity,
            'is_active' => $productDto->isActive,
            'user_id_updated' => $this->userLoggedId,
        ];

        return $product->update($data);
    }

    public function delete(int $id): bool
    {
        $product = $this->model->find($id);

        if (!$product) {
            throw new Exception("Produto não encontrado.");
        }

        $product->images->each(function ($image) {
            $this->deleteOldImage($image->image);
            $image->delete();
        });

        $product->user_id_deleted = $this->userLoggedId;
        $product->deleted_at = now();
        
        return $product->save();
    }

    public function getProductCountByMonth(Carbon $date): int
    {
        $count = $this->model
            ->where('owner_id', $this->ownerId)
            ->whereBetween('created_at', [
                $date->copy()->startOfMonth(),
                $date->copy()->endOfMonth()
            ])
            ->count();

        return $count;
    }
}
