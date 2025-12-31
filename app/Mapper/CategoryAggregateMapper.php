<?php

namespace App\Mapper;

use App\Http\Dto\Category\CategoryAggregateDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class CategoryAggregateMapper
{
    public static function map(LengthAwarePaginator $categories): LengthAwarePaginator
    {
        $categories->getCollection()->transform(function ($category) {
            return new CategoryAggregateDto(
                id: $category->id,
                name: $category->name,
                description: $category->description,
                userCreatedName: $category->user_created_name,
                userUpdatedName: $category->user_updated_name,
                createdAt: Carbon::parse($category->created_at),
                updatedAt: Carbon::parse($category->updated_at)
            );
        });

        return $categories;
    }
}