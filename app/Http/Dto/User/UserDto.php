<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;
use App\Http\Dto\UserDetails\UserDetailsDto;

class UserDto extends BaseDto
{
	public function __construct(
		public string $email,
		public ?string $password,
		public bool $isActive,
		public int $profileId,
		public int $userIdCreate,
		public UserDetailsDto $userDetailsDto) {}
}