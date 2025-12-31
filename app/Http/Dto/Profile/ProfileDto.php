<?php

namespace App\Http\Dto\Profile;

use App\Http\Dto\BaseDto;

class ProfileDto extends BaseDto
{
	public function __construct(
		public string $name,
		public string|null $description,
		public string $permissions,
	) {}
}