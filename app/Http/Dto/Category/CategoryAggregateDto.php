<?php

namespace App\Http\Dto\Category;

use App\Http\Dto\BaseDto;
use Carbon\Carbon;

class CategoryAggregateDto extends BaseDto
{
	public function __construct(
        public int $id,
		public string $name,
        public string|null $description,
        public Carbon $createdAt,
        public Carbon $updatedAt) {}
}