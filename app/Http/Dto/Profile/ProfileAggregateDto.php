<?php

namespace App\Http\Dto\Profile;

use App\Http\Dto\BaseDto;
use Carbon\Carbon;

class ProfileAggregateDto extends BaseDto
{
	public function __construct(
        public int $id,
		public string $name,
        public string|null $description,
		public int $userIdCreated,
        public int|null $userIdUpdated,
        public Carbon $createdAt,
        public Carbon $updatedAt) {}
}