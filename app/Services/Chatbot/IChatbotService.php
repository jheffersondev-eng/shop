<?php

namespace App\Services\Chatbot;

use App\Http\Dto\Chatbot\ChatbotDto;

interface IChatbotService
{
    public function send(ChatbotDto $chatbotDto, int $userId);
}