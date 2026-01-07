<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;

class VerifyEmailDto extends BaseDto
{
	public function __construct(
		public string $verificationCode,
		public string $userId,
    ) {}
}