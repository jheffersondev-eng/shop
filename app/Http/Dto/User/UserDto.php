<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;
use App\Http\Dto\UserDetails\UserDetailsDto;

class UserDto extends BaseDto
{
	public function __construct(
		public string $email,
		public string|null $password,
		public bool $isActive,
		public int|null $profileId,
		public UserDetailsDto $userDetailsDto,
		public int|null $ownerId) {}
}