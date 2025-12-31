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
        public array $permissions,
		public int $userIdCreated,
        public int|null $userIdUpdated,
        public string|null $userCreatedName,
        public string|null $userUpdatedName,
        public Carbon $createdAt,
        public Carbon $updatedAt) {}
}