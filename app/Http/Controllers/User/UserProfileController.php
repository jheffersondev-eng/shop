<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Services\Profile\IProfileService;
use App\Services\User\IUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserProfileController extends BaseController
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

    public function Edit(int $id): View
    {
        $user = $this->userService->getUserById($id);
        $profiles = $this->profileService->getProfiles();

        return view('userProfile.edit', [
            'url' => route('userProfile.edit', $id),
            'user' => $user,
            'profiles' => $profiles,
        ]);
    }

    public function Update(UpdateUserProfileRequest $updateUserRequest, int $id): RedirectResponse
    {
        $dto = $updateUserRequest->getDto();

        return $this->execute(
            callback: fn() => $this->userService->update($dto, $id),
            defaultSuccessMessage: 'Seu perfil foi atualizado com sucesso',
            successRedirect: route('user.index'),
        );
    }
}