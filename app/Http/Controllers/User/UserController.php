<?php

namespace App\Http\Controllers\User;

use App\Enums\EIsActive;
use App\Http\Controllers\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\FilterRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Profile\IProfileService;
use App\Services\User\IUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends BaseController
{
    protected IUserService $userService;
    protected IProfileService $profileService;

    public function __construct(
        IUserService $userService,
        IProfileService $profileService
    ) 
    {
        $this->userService = $userService;
        $this->profileService = $profileService;
    }

    public function Index(FilterRequest $filterRequest): View
    {
        $users = $this->userService->getUsersByFilter($filterRequest->getDto());
        $profiles = $this->profileService->getProfiles();
        $isActive = EIsActive::toArrayOptions();

        return view('user.index', [
            'url' => route('user.index'),
            'title' => 'Usuário',
            'users' => $users,
            'profiles' => $profiles,
            'isActive' => $isActive,
        ]);
    }

    public function Create(): View
    {
        $profiles = $this->profileService->getProfiles();
        $isActive = EIsActive::toArrayOptions();

        return view('user.create', [
            'url' => route('user.index'),
            'profiles' => $profiles,
            'isActive' => $isActive,
        ]);
    }

    public function Edit(int $id): View
    {
        $user = $this->userService->getUserById($id);
        $profiles = $this->profileService->getProfiles();
        $isActive = EIsActive::toArrayOptions();

        return view('user.edit', [
            'url' => route('user.index'),
            'user' => $user,
            'profiles' => $profiles,
            'isActive' => $isActive,
        ]);
    }

    public function Store(CreateUserRequest $createUserRequest): RedirectResponse
    {
        $dto = $createUserRequest->getDto();
        return $this->execute(
            callback: fn() => $this->userService->create($dto),
            defaultSuccessMessage: 'Usuário criado com sucesso',
            successRedirect: route('user.index'),
        );
    }

    public function Update(UpdateUserRequest $updateUserRequest, int $id): RedirectResponse
    {
        $dto = $updateUserRequest->getDto();

        return $this->execute(
            callback: fn() => $this->userService->update($dto, $id),
            defaultSuccessMessage: 'Usuário atualizado com sucesso',
            successRedirect: route('user.index'),
        );
    }

    public function Destroy(int $id): RedirectResponse
    {
        return $this->execute(
            callback: fn() => $this->userService->delete($id),
            defaultSuccessMessage: 'Usuário removido com sucesso',
            successRedirect: route('user.index'),
        );
    }
}