<?php

namespace App\Services\Category;

use App\Http\Dto\Category\CategoryDto;
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
        return $this->categoryRepository->getCategories();
    }

    public function getCategoryById(int $id): Category
    {
        return $this->categoryRepository->getCategoryById($id);
    }
    
    public function create(CategoryDto $categoryDto): ServiceResult
    {
        try {
            $category = $this->categoryRepository->create($categoryDto);

            return ServiceResult::ok(
                data: $category,
                message: 'Usuário criado com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao criar usuário: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar usuário');
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
