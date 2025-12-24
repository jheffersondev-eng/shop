<?php

namespace App\Repositories\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Category\FilterDto;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryRepository
{
    public function getCategories(): LengthAwarePaginator;
    public function getCategoriesByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function getCategoryById(int $id): Category;
    public function create(CategoryDto $categoryDto): Category;
    public function update(CategoryDto $categoryDto, int $id);
    public function delete(int $id);
}
