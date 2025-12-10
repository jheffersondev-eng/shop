<?php

namespace App\Repositories\Category;

interface ICategoryRepository
{
    public function getCategories();
    public function store($request);
    public function updateCategory($id, array $data);
}
