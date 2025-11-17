<?php

namespace App\Repositories\Product;

use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\User\UpdateUserDto;
use App\Models\User;
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
}
