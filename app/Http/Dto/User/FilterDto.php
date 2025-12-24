<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;
use Carbon\Carbon;

class FilterDto extends BaseDto
{
	public function __construct(
        public int|null $id,
        public string|null $name,
		public string|null $email,
        public int|null $profileId,
		public bool|null $isActive,
		public Carbon|null $dateDe,
		public Carbon|null $dateAte) {}
}