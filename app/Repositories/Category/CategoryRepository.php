<?php

namespace App\Repositories\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Category\FilterDto;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    const PAGINATION_SIZE = 10;
    protected int $userLoggedId;
    protected int $ownerId;

    public function __construct()
    {
        parent::__construct(new Category());
        $this->userLoggedId = Auth::id();
        $this->ownerId = Auth::user()->owner_id;
    }

    public function getCategories(): LengthAwarePaginator
    {
        return $this->model->where('owner_id', '=', $this->ownerId)
            ->paginate(self::PAGINATION_SIZE);
    }

    public function getCategoriesByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        $query = DB::table('categories as c')
            ->leftJoin('users as uc', 'c.user_id_created', '=', 'uc.id')
            ->leftJoin('users as uu', 'c.user_id_updated', '=', 'uu.id')
            ->leftJoin('user_details as udc', 'uc.id', '=', 'udc.user_id')
            ->leftJoin('user_details as udu', 'uu.id', '=', 'udu.user_id')
            ->select(
                    'c.id',
                    'c.name',
                    'c.description',
                    'udc.name as user_created_name',
                    'udu.name as user_updated_name',
                    'c.created_at',
                    'c.updated_at'
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, FilterDto $filterDto)
    {
        $query->whereNull('c.deleted_at')
            ->where(function($q) {
                $q->where('c.user_id_created', '=', $this->userLoggedId)
                    ->orWhere('c.owner_id', '=', $this->ownerId);
            }); 
        
        $query->whereNull('c.deleted_at');

        if ($filterDto->id) {
            $query->where('id', $filterDto->id);
        }

        if ($filterDto->name) {
            $query->where('name', 'like', '%'.$filterDto->name.'%');
        }

        if ($filterDto->dateDe) {
            $query->whereDate('created_at', '>=', $filterDto->dateDe);
        }

        if ($filterDto->dateAte) {
            $query->whereDate('created_at', '<=', $filterDto->dateAte);
        }

        return $query;
    }

    public function getCategoryById(int $id): Category
    {
        $category = $this->model->where('id', $id)
            ->where('owner_id', '=', $this->ownerId)
            ->first();

        if (!$category) {
            throw new Exception("Categoria não encontrada.");
        }

        return $category;
    }

    public function create(CategoryDto $categoryDto): Category
    {
        $data = [
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
            'user_id_created' => $this->userLoggedId,
            'owner_id' => $this->ownerId,
        ];

        return $this->model->create($data);
    }

    public function update(CategoryDto $categoryDto, int $id)
    {
        $category = $this->model->where('id', $id)
            ->where('owner_id', '=', $this->ownerId)
            ->first();

        if (!$category) {
            throw new Exception("Categoria não encontrada.");
        }
        
        $data = [
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
            'user_id_updated' => $this->userLoggedId,
        ];

        return $category->update($data);
    }

    public function delete(int $id)
    {
        $category = $this->model->where('id', $id)
            ->where('owner_id', '=', $this->ownerId)
            ->first();

        if (!$category) {
            throw new Exception("Categoria não encontrada.");
        }

        $category->user_id_deleted = $this->userLoggedId;
        $category->deleted_at = now();
        
        return $category->save();
    }
}
