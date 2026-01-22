<?php

namespace App\Services\Company;

use App\Http\Dto\Company\CompanyDto;
use App\Models\Company;
use App\Services\ServiceResult;

interface ICompanyService
{
    public function getCompany(): Company|null;
    public function create(CompanyDto $companyDto): ServiceResult;
    public function update(CompanyDto $companyDto): ServiceResult;
    public function delete(): ServiceResult;
}