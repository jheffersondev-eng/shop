<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;

class VerifyDto extends BaseDto
{
	public function __construct(
		public string $email,
		public string $userId,
    ) {}
}