<?php

namespace App\Repositories\Profile;

use App\Models\Profile;
use App\Repositories\BaseRepository;

class ProfileRepository extends BaseRepository implements IProfileRepository
{
    public function __construct()
    {
        parent::__construct(new Profile());
    }

    public function getProfiles()
    {
        return $this->model->withoutTrashed()->get();
    }

    public function getProfileById($id)
    {
        return $this->model->withoutTrashed()->find($id);
    }

    public function store($request)
    {
        $data = method_exists($request, 'validated') ? $request->validated() : $request->all();
        $this->model->getModel()->create($data);
    }

    public function updateProfile($id, array $data)
    {
        $profile = $this->getProfileById($id);
        if ($profile) {
            $profile->update($data);
            return $profile;
        }
        return null;
    }

    public function delete(Profile $profile)
    {
        return $profile->delete();
    }
}
