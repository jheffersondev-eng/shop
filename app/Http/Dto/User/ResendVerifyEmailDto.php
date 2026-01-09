<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;

class ResendVerifyEmailDto extends BaseDto
{
	public function __construct(
		public string $email,
		public string $userId,
    ) {}
}