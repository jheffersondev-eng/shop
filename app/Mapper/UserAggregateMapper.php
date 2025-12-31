<?php

namespace App\Mapper;

use App\Http\Dto\Profile\ProfileDto;
use App\Http\Dto\User\UserAggregateDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class UserAggregateMapper
{
    public static function map(LengthAwarePaginator $users): LengthAwarePaginator
    {
        $users->getCollection()->transform(function ($user) {
            return new UserAggregateDto(
                id: $user->id,
                email: $user->email,
                profile: new ProfileDto(
                    name: $user->profile_name,
                    description: $user->profile_description,
                    permissions: $user->profile_permissions,
                ),
                isActive: $user->is_active,
                userIdCreated: $user->user_id_created,
                userIdUpdated: $user->user_id_updated,
                userCreatedName: $user->user_created_name,
                userUpdatedName: $user->user_updated_name,
                userDetails: new UserDetailsDto(
                    name: $user->detail_name,
                    document: $user->document,
                    birthDate: Carbon::parse($user->birth_date),
                    phone: $user->phone,
                    address: $user->address,
                    creditLimit: $user->credit_limit,
                    image: $user->image,
                    userId: $user->user_id ?? null,
                ),
                createdAt: Carbon::parse($user->created_at),
                updatedAt: Carbon::parse($user->updated_at)
            );
        });

        return $users;
    }
}