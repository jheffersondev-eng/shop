<?php

namespace App\Http\Dto\Unit;

use App\Http\Dto\BaseDto;
use Carbon\Carbon;

class UnitAggregateDto extends BaseDto
{
	public function __construct(
        public int $id,
		public string $name,
		public string $abbreviation,
		public string $format,
		public string|null $userCreatedName,
		public string|null $userUpdatedName,
        public Carbon $createdAt,
        public Carbon $updatedAt) {}
}