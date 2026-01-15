<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\About\AboutRequest;
use App\Services\About\IAboutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function documentation(): View
    {
        return view("home.documentation", [
            'url' => route('documentation.index'),
            'title' => "Documentation",
        ]);
    }

    public function downloadCurriculum(): BinaryFileResponse
    {
        $filePath = public_path('assets/document/Jhefferson-Curriculo-12012026.pdf');
        return response()->download($filePath, 'Jhefferson-Curriculo-12012026.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function sendMail(AboutRequest $request): RedirectResponse
    { 
        $dto = $request->getDto();
        $this->aboutService->sendMail($dto);
        return redirect()->back()->with('success', 'E-mail enviado com sucesso! Você receberá uma resposta em breve.');
    }
}