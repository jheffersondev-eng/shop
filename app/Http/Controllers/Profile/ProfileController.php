<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Repositories\Profile\IProfileRepository;

class ProfileController extends BaseController
{
    public function __construct(IProfileRepository $profileRepository)
    {
        parent::__construct($profileRepository);

        $this->setPages(10);
        $this->setName('Profile');
        $this->setUrl(url('profile'));
        $this->setFolderView('profile');
        $this->setOrderList(['id', 'asc']);
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request)->with('profiles', $this->repository->getProfiles());
    }

    public function Create()
    {
        return parent::CreateBase();
    }

    public function Store(Request $request)
    {
        return parent::StoreBase($request);
    }

    public function Edit($id)
    {
        $profile = $this->repository->getProfileById($id);
        return parent::EditBase($profile)->with('profile', $profile);
    }

    public function Update(Request $request, int $id)
    {
        $data = $request->all();
        $this->repository->updateProfile($id, $data);
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    public function Destroy(Request $request, int $id)
    {
        $profile = $this->repository->find($id);
        return parent::DestroyBase($profile, $request);
    }
}
