<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Services\Company\ICompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends BaseController
{
    public function __construct(
        private ICompanyService $companyService
    ) {}

    public function index(): View
    {
        $company = $this->companyService->getCompany();

        return view('company.index', [
            'url' => route('company.index'),
            'title' => 'Loja',
            'company' => $company,
        ]);
    }

    public function create(): View
    {
        return view('company.create', [
            'url' => route('company.index'),
        ]);
    }

    public function edit(): View
    {
        $company = $this->companyService->getCompany();

        return view('company.edit', [
            'url' => route('company.edit'),
            'company' => $company,
        ]);
    }

    public function store(CompanyRequest $companyRequest): RedirectResponse
    {
        $dto = $companyRequest->getDto();

        return $this->execute(
            callback: fn() => $this->companyService->create($dto),
            defaultSuccessMessage: 'Loja criada com sucesso',
            successRedirect: route('company.index'),
        );
    }

    public function update(CompanyUpdateRequest $companyRequest): RedirectResponse
    {
        $dto = $companyRequest->getDto();

        return $this->execute(
            callback: fn() => $this->companyService->update($dto),
            defaultSuccessMessage: 'Loja atualizada com sucesso',
            successRedirect: route('company.index'),
        );
    }

    public function destroy(): RedirectResponse
    {
        return $this->execute(
            callback: fn() => $this->companyService->delete(),
            defaultSuccessMessage: 'Loja removida com sucesso',
            successRedirect: route('company.index'),
        );
    }
}
