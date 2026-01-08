<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\About\AboutRequest;
use App\Services\About\IAboutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController 
{
    protected IAboutService $aboutService;

    public function __construct(IAboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }
    
    public function about(): View
    {
        return view("home.about", [
            'url' => route('about'),
            'title' => "About",
        ]);
    }

    public function sendMail(AboutRequest $request): RedirectResponse
    { 
        $dto = $request->getDto();
        $this->aboutService->sendMail($dto);
        return redirect()->back()->with('success', 'E-mail enviado com sucesso! Você receberá uma resposta em breve.');
    }
}