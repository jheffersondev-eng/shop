<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;
use App\Http\Dto\Profile\ProfileDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use Carbon\Carbon;

class UserAggregateDto extends BaseDto
{
	public function __construct(
        public int $id,
		public string $email,
		public ProfileDto $profile,
		public bool $isActive,
		public int|null $userIdCreated,
		public int|null $userIdUpdated,
		public string|null $userCreatedName,
		public string|null $userUpdatedName,
		public UserDetailsDto $userDetails,
        public Carbon $createdAt,
        public Carbon $updatedAt) {}
}