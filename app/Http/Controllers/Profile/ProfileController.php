<?php

namespace App\Http\Controllers\Profile;

use App\Enums\EIsActive;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Profile\FilterRequest;
use App\Http\Requests\Profile\ProfileRequest;
use App\Services\Profile\IProfileService;
use Illuminate\Http\RedirectResponse;

class ProfileController extends BaseController
{
    protected IProfileService $profileService;
    
    public function __construct(IProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function Index(FilterRequest $filterRequest)
    {      
        $profiles = $this->profileService->getProfilesByFilter($filterRequest->getDto());
        $isActive = EIsActive::toArrayOptions();

        return view('profile.index', [
            'url' => route('profile.index'),
            'title' => 'Perfis',
            'profiles' => $profiles,
            'isActive' => $isActive,
        ]);
    }

    public function Create()
    {
        $modulesPermissions = $this->profileService->getModulesPermissions();        

        return view('profile.create', [
            'url' => route('profile.index'),
            'modulesPermissions' => $modulesPermissions,
        ]);
    }

    public function Edit(int $id)
    {
        $profile = $this->profileService->getProfileById($id);
        $modulesPermissions = $this->profileService->getModulesPermissions();        

        return view('profile.edit')->with([
            'url' => route('profile.index'),
            'profile' => $profile,
            'modulesPermissions' => $modulesPermissions,
        ]);
    }

    public function Store(ProfileRequest $profileRequest): RedirectResponse
    {
        $dto = $profileRequest->getDto();

        return $this->execute(
            callback: fn() => $this->profileService->create($dto),
            defaultSuccessMessage: 'Perfil criado com sucesso',
            successRedirect: route('profile.index'),
        );
    }

    public function Update(ProfileRequest $profileRequest, int $id)
    {
        $dto = $profileRequest->getDto();

        return $this->execute(
            callback: fn() => $this->profileService->update($dto, $id),
            defaultSuccessMessage: 'Perfil atualizado com sucesso',
            successRedirect: route('profile.index'),
        );
    }

    public function Destroy(int $id)
    {
        return $this->execute(
            callback: fn() => $this->profileService->delete($id),
            defaultSuccessMessage: 'Perfil removido com sucesso',
            successRedirect: route('profile.index'),
        );
    }
}
