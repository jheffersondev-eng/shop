<?php

namespace App\Repositories\Company;

use App\Http\Dto\Company\CompanyDto;
use App\Models\Company;

interface ICompanyRepository
{
    public function getCompany(): Company|null;
    public function create(CompanyDto $companyDto): Company;
    public function update(CompanyDto $companyDto): bool;
    public function delete(): Company;
}
