<?php

namespace App\Services\Profile;

use App\Http\Dto\Profile\FilterDto;
use App\Http\Dto\Profile\ProfileDto;
use App\Models\Profile;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProfileService
{
    public function getProfiles(): LengthAwarePaginator;
    public function getProfilesByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function getProfileById(int $id): Profile;
    public function create(ProfileDto $profileDto): ServiceResult;
    public function update(ProfileDto $profileDto, int $id): ServiceResult;
    public function delete(int $id): ServiceResult;
}