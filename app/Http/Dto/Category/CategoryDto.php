<?php

namespace App\Http\Dto\Category;

use App\Http\Dto\BaseDto;

class CategoryDto extends BaseDto
{
	public function __construct(
		public string $name,
		public ?string $description,
	) {}
}