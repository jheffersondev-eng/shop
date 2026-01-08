<?php

namespace App\Http\Dto\About;

use App\Http\Dto\BaseDto;

class SendEmailDto extends BaseDto
{
	public function __construct(
		public string $name,
        public string $email,
        public string $subject,
        public string $message,
	) {}
}