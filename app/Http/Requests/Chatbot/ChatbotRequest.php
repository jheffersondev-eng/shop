<?php

namespace App\Http\Requests\Chatbot;

use App\Http\Dto\Chatbot\ChatbotDto;
use App\Http\Requests\BaseRequest;

class ChatbotRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->normalizeInputs();

        $rules = [
            'message' => 'required|string|max:5000',
            'conversation' => 'sometimes|array',
        ];

        return $rules;
    }

    protected function normalizeInputs(): void
    {
        $this->merge([
            'message' => strtoupper($this->input('message')),
        ]);
    }

    public function messages(): array
    {
        return [
            'message.required' => 'A mensagem é obrigatória.',
            'message.string' => 'A mensagem deve ser uma string válida.',
            'message.max' => 'A mensagem não pode exceder 5000 caracteres.',
            'conversation.array' => 'A conversa deve ser um array válido.',
        ];
    }

    public function getDto(): ChatbotDto
    {
        return new ChatbotDto(
            $this->input('message'),
            $this->input('conversation'),
        );
    }
}