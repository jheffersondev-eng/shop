<?php

namespace App\Http\Dto\Profile;

use App\Http\Dto\BaseDto;
use Carbon\Carbon;

class FilterDto extends BaseDto
{
	public function __construct(
        public int|null $id,
        public string|null $name,
		public Carbon|null $dateDe,
		public Carbon|null $dateAte) {}
}