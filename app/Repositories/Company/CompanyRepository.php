<?php

namespace App\Repositories\Company;

use App\Http\Dto\Company\CompanyDto;
use App\Models\Company;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyRepository extends BaseRepository implements ICompanyRepository
{
    protected int $userLoggedId;
    protected int $ownerId;

    public function __construct()
    {
        parent::__construct(new Company());
        $this->userLoggedId = Auth::id();
        $this->ownerId = Auth::user()->owner_id;
    }

    public function getCompany(): Company|null
    {
        return $this->model->where('owner_id', '=', $this->ownerId)->first();
    }

    public function create(CompanyDto $companyDto): Company
    {
        $imagePath = $companyDto->image->store('company', 'public');

        $company = Company::create([
            'owner_id' => $this->ownerId,
            'fantasy_name' => $companyDto->fantasyName,
            'legal_name' => $companyDto->legalName,
            'document' => $companyDto->document,
            'email' => $companyDto->email,
            'phone' => $companyDto->phone,
            'image' => $imagePath,
            'primary_color' => $companyDto->primaryColor,
            'secondary_color' => $companyDto->secondaryColor,
            'domain' => $companyDto->domain,
            'zip_code' => $companyDto->zipCode,
            'neighborhood' => $companyDto->neighborhood,
            'state' => $companyDto->state,
            'city' => $companyDto->city,
            'street' => $companyDto->street,
            'number' => $companyDto->number,
            'complement' => $companyDto->complement,
            'description' => $companyDto->description,
            'is_active' => $companyDto->isActive,
            'user_id_created' => $this->userLoggedId,
        ]);

        return $company;
    }

    public function update(CompanyDto $companyDto): bool
    {
        $company = $this->getCompany();
        $imagePath = $company->image;

        if($companyDto->image)
        {
            Storage::disk('public')->delete($company->image);
            $imagePath = $companyDto->image->store('company', 'public');
        }

        return $company->update([
            'owner_id' => $this->ownerId,
            'fantasy_name' => $companyDto->fantasyName,
            'legal_name' => $companyDto->legalName,
            'document' => $companyDto->document,
            'email' => $companyDto->email,
            'phone' => $companyDto->phone,
            'image' => $imagePath,
            'primary_color' => $companyDto->primaryColor,
            'secondary_color' => $companyDto->secondaryColor,
            'domain' => $companyDto->domain,
            'zip_code' => $companyDto->zipCode,
            'neighborhood' => $companyDto->neighborhood,
            'state' => $companyDto->state,
            'city' => $companyDto->city,
            'street' => $companyDto->street,
            'number' => $companyDto->number,
            'complement' => $companyDto->complement,
            'description' => $companyDto->description,
            'is_active' => $companyDto->isActive,
            'user_id_updated' => $this->userLoggedId,
            ]);
    }

    public function delete(): Company
    {
        $company = $this->getCompany();
        $company->user_id_deleted = $this->userLoggedId;
        $company->is_active = false;
        $company->deleted_at = now();   
        $company->save();

        return $company;
    }
}