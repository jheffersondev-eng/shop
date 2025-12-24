<?php

namespace App\Mapper;

use App\Http\Dto\Profile\ProfileAggregateDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class ProfileAggregateMapper
{
    public static function map(LengthAwarePaginator $profiles): LengthAwarePaginator
    {
        $profiles->getCollection()->transform(function ($profile) {
            return new ProfileAggregateDto(
                id: $profile->id,
                name: $profile->name,
                description: $profile->description,
                userIdCreated: $profile->user_id_created,
                userIdUpdated: $profile->user_id_updated,
                createdAt: Carbon::parse($profile->created_at),
                updatedAt: Carbon::parse($profile->updated_at)
            );
        });

        return $profiles;
    }
}