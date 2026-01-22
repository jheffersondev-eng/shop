<?php

namespace App\Http\Dto\Company;

use App\Http\Dto\BaseDto;
use Illuminate\Http\UploadedFile;

class CompanyDto extends BaseDto
{
	public function __construct(
		public string $fantasyName,
		public string $legalName,
		public string|null $document,
		public string $email,
		public string $phone,
		public UploadedFile|null $image,
		public string $primaryColor,
		public string $secondaryColor,
		public string $neighborhood,
		public string $domain,
		public string $zipCode,
		public string $state,
		public string $city,
		public string $street,
		public string $number,
		public string|null $complement,
		public string|null $description,
		public bool $isActive,
	) {}
}
