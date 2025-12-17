<?php

namespace App\Http\Dto\Unit;

use App\Http\Dto\BaseDto;

class UnitDto extends BaseDto
{
	public function __construct(
		public string $name,
		public string $abbreviation,
		public int $format) {}
}