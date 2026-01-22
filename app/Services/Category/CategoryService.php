<?php

namespace App\Services\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Category\FilterDto;
use App\Mapper\CategoryAggregateMapper;
use App\Models\Category;
use App\Repositories\Category\ICategoryRepository;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryService implements ICategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(): LengthAwarePaginator
    {
        try {
            $categories = $this->categoryRepository->getCategories();
            return $categories;

        } catch (Throwable $e) {
            Log::error('Erro ao listar categorias: '.$e->getMessage());
            throw $e;
        }
    }

    public function getCategoriesByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        try {
            $categories = $this->categoryRepository->getCategoriesByFilter($filterDto);
            $categoriesAggregate = CategoryAggregateMapper::map($categories);
            
            return $categoriesAggregate;
        } catch (Throwable $e) {
            Log::error('Erro ao filtrar categorias: '.$e->getMessage());
            throw $e;
        }
    }

    public function getCategoryById(int $id): Category
    {
        try {
            $category = $this->categoryRepository->getCategoryById($id);
            return $category;

        } catch (Throwable $e) {
            Log::error('Erro ao obter categoria por ID: '.$e->getMessage());
            throw $e;
        }
    }
    
    public function create(CategoryDto $categoryDto): ServiceResult
    {
        try {
            $category = $this->categoryRepository->create($categoryDto);

            return ServiceResult::ok(
                data: $category,
                message: 'Categoria criada com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao criar categoria: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar categoria');
        }
    }
    
    public function update(CategoryDto $categoryDto, int $id): ServiceResult
    {
        try {
            $this->categoryRepository->update($categoryDto, $id);

            return ServiceResult::ok(
                message: 'Categoria atualizada com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao atualizar categoria: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao atualizar categoria');
        }
    }
    
    public function delete(int $id): ServiceResult
    {
        try {
            $this->categoryRepository->delete($id);

            return ServiceResult::ok(
                message: 'Categoria removida com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao remover categoria: '.$e->getMessage());
            return ServiceResult::fail('Erro ao remover categoria');
        }
    }
}
