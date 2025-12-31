<?php

namespace App\Mapper;

use App\Http\Dto\Unit\UnitAggregateDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class UnitAggregateMapper
{
    public static function map(LengthAwarePaginator $units): LengthAwarePaginator
    {
        $units->getCollection()->transform(function ($unit) {
            return new UnitAggregateDto(
                id: $unit->id,
                name: $unit->name,
                abbreviation: $unit->abbreviation,
                format: $unit->format,
                userCreatedName: $unit->user_created_name,
                userUpdatedName: $unit->user_updated_name,
                createdAt: Carbon::parse($unit->created_at),
                updatedAt: Carbon::parse($unit->updated_at)
            );
        });

        return $units;
    }
}