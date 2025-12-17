<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Profile\ProfileRequest;
use Illuminate\Http\Request;
use App\Services\Profile\IProfileService;
use Illuminate\Http\RedirectResponse;

class ProfileController extends BaseController
{
    protected IProfileService $profileService;
    
    public function __construct(IProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function Index(Request $request)
    {
        $profiles = $this->profileService->getProfiles();

        return view('profile.index', [
            'url' => route('profile.index'),
            'title' => 'Perfis',
            'profiles' => $profiles,
        ]);
    }

    public function Create()
    {
        return view('profile.create', [
            'url' => route('profile.index'),
        ]);
    }

    public function Edit(int $id)
    {
        $profile = $this->profileService->getProfileById($id);

        return view('profile.edit')->with([
            'url' => route('profile.index'),
            'profile' => $profile,
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

    public function Destroy(Request $request, int $id)
    {
        return $this->execute(
            callback: fn() => $this->profileService->delete($id),
            defaultSuccessMessage: 'Perfil removido com sucesso',
            successRedirect: route('profile.index'),
        );
    }
}
