<?php

namespace App\Services\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Category\FilterDto;
use App\Models\Category;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryService
{
    public function getCategories(): LengthAwarePaginator;
    public function getCategoriesByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function getCategoryById(int $id): Category;
    public function create(CategoryDto $categoryDto): ServiceResult;
    public function update(CategoryDto $categoryDto, int $id): ServiceResult;
    public function delete(int $id): ServiceResult;
}