<?php

namespace App\Services\Company;

use App\Http\Dto\Company\CompanyDto;
use App\Models\Company;
use App\Repositories\Company\ICompanyRepository;
use App\Services\ServiceResult;
use Illuminate\Support\Facades\Log;
use Throwable;

class CompanyService implements ICompanyService
{
    protected ICompanyRepository $companyRepository;

    public function __construct(ICompanyRepository $companyRepository) 
    {
        $this->companyRepository = $companyRepository;
    }

    public function getCompany(): Company|null
    {
        try {
            $company = $this->companyRepository->getCompany();
            return $company;

        } catch (Throwable $e) {
            Log::error('Erro ao listar loja: '.$e->getMessage());
            throw $e;
        }
    }

    public function create(CompanyDto $companyDto): ServiceResult
    {
        try {
            $company =  $this->getCompany();

            if ($company) {
                return ServiceResult::fail(
                    message: 'Já existe uma loja cadastrada para este proprietário'
                );
            }
            
            $company = $this->companyRepository->create($companyDto);
            
            return ServiceResult::ok(
                data: $company,
                message: 'Loja criada com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao criar loja: '.$e->getMessage());
            throw $e;
        }
    }

    public function update(CompanyDto $companyDto): ServiceResult
    {
        try {
            $company = $this->companyRepository->update($companyDto);
            
            return ServiceResult::ok(
                data: $company,
                message: 'Loja atualizada com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao atualizar loja: '.$e->getMessage());
            throw $e;
        }
    }

    public function delete(): ServiceResult
    {
        try {
            $company = $this->companyRepository->delete();
            
            return ServiceResult::ok(
                data: $company,
                message: 'Loja deletada com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao deletar loja: '.$e->getMessage());
            throw $e;
        }
    }
}