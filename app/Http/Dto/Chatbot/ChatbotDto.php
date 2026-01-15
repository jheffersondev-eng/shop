<?php

namespace App\Http\Dto\Chatbot;

use App\Http\Dto\BaseDto;

class ChatbotDto extends BaseDto
{
	public function __construct(
		public string $message,
		public array|null $conversation,
	) {}
}