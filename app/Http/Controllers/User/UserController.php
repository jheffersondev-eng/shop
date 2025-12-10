<?php

namespace App\Http\Controllers\User;

use App\Enums\EIsActive;
use App\Http\Controllers\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\User\IUserRepository;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Profile\IProfileRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected IProfileRepository $profileRepository;

    public function __construct(IUserRepository $userRepository, IProfileRepository $profileRepository)
    {
        parent::__construct($userRepository);
        $this->profileRepository = $profileRepository;

        $this->setPages(10);
        $this->setName('Usuário');
        $this->setUrl(url("user"));
        $this->setFolderView("user");
        $this->setOrderList(['id', 'asc']);
    }

    public function Index(Request $request): View
    {
        return parent::IndexBase($request)->with('users', $this->repository->getUsers());
    }

    public function Create(): View
    {
        $profiles = $this->profileRepository->getProfiles();
        return parent::CreateBase()
            ->with('profiles', $profiles)
            ->with('isActive', EIsActive::toArray());
    }

    public function Store(CreateUserRequest $createUserRequest): RedirectResponse
    {
        return parent::StoreBase($createUserRequest);
    }

    public function Edit(User $user): View
    {
        $profiles = Profile::withoutTrashed()->get();
        return parent::EditBase($user)
            ->with('user', $user)
            ->with('profiles', $profiles)
            ->with('profile_id', $user->profile_id)
            ->with('isActive', EIsActive::toArray());
    }

    public function Update(UpdateUserRequest $updateUserRequest, User $user): RedirectResponse
    {
        $updateUserRequest->request->add(['id' => $user->id]);
        return parent::UpdateBase($user, $updateUserRequest);
    }

    public function Destroy(Request $request, User $user): RedirectResponse
    {
        return parent::DestroyBase($user, $request);
    }
}