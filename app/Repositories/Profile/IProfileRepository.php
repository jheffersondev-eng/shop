<?php

namespace App\Repositories\Profile;

use App\Http\Dto\Profile\FilterDto;
use App\Http\Dto\Profile\ProfileDto;
use App\Models\Profile;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProfileRepository
{
    public function getProfiles(): LengthAwarePaginator;
    public function getProfileById(int $id): Profile;
    public function getProfilesByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function create(ProfileDto $profileDto): Profile;
    public function update(int $id, ProfileDto $profileDto);
    public function delete(int $id);
}
