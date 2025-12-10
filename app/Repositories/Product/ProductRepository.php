<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function getProducts()
    {
        return $this->model->withoutTrashed()->get();
    }

    public function store(array $data)
    {
        $this->model->create($data);
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->model->withoutTrashed()->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        
        return null;
    }
}
