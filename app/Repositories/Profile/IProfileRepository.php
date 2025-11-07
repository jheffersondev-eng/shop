<?php

namespace App\Repositories\Profile;

interface IProfileRepository
{
    public function getProfiles();
    public function getProfileById($id);
    public function store($request);
    public function updateProfile($id, array $data);
}
