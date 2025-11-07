<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\User\IUserRepository;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(IUserRepository $userRepository)
    {
        parent::__construct($userRepository);

        $this->setPages(10);
        $this->setName('User');
        $this->setUrl(url("user"));
        $this->setFolderView("user");
        $this->setOrderList(['id', 'asc']);
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request)->with('users', $this->repository->getUsers());
    }

    public function Edit(User $user)
    {
        $profiles = Profile::withoutTrashed()->get();
        return parent::EditBase($user)->with('user', $user)->with('profiles', $profiles);
    }

    public function Update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        $userUpdateRequest->request->add(['id' => $user->id]);
        return parent::UpdateBase($user, $userUpdateRequest);
    }

    public function Destroy(Request $request, User $user)
    {
        return parent::DestroyBase($user, $request);
    }
}