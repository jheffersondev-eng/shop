<?php

namespace App\Http\Dto\UserDetails;

use App\Http\Dto\BaseDto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

class UserDetailsDto extends BaseDto
{
	public function __construct(
		public string $name,
        public string $document,
        public Carbon $birthDate,
        public string $phone,
        public string $address,
        public float $creditLimit,
        public string|UploadedFile|null $image,
        public int|null $userId,
    ) {}
}