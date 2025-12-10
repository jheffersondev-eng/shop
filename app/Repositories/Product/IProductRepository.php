<?php

namespace App\Repositories\Product;

interface IProductRepository
{
    public function getProducts();
    public function store(array $data);
    public function updateProduct($id, array $data);
}