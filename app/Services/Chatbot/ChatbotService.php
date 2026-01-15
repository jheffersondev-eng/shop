<?php

namespace App\Services\Chatbot;

use App\Http\Dto\Chatbot\ChatbotDto;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ChatbotService implements IChatbotService
{
    public function send(ChatbotDto $chatbotDto, int $userId)
    {
        try {
            // Construir mensagem com contexto do sistema
            $contextualMessage = ChatbotKnowledgeBase::buildContextualPrompt($chatbotDto->message);
            
            // Adicionar histórico da conversa se existir
            $messageWithHistory = $this->buildContextualMessage($contextualMessage, $chatbotDto->conversation ?? []);

            $apiUrl = config('services.chatbot.url');
            $apiKey = config('services.chatbot.api_key');

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->timeout(30)
            ->retry(2, 100)
            ->post("{$apiUrl}/chat", [
                'message' => $messageWithHistory,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Desculpe, o serviço de IA está temporariamente indisponível. Tente novamente em alguns instantes.',
                ], 503);
            }

            $data = $response->json();

            $botResponse = $data['message'] 
                ?? $data['response'] 
                ?? $data['reply'] 
                ?? $data['text'] 
                ?? null;

            if (!$botResponse && isset($data['data']['message'])) {
                $botResponse = $data['data']['message'];
            }

            if (!$botResponse && isset($data['data']['response'])) {
                $botResponse = $data['data']['response'];
            }

            if (!$botResponse && isset($data['data']['reply'])) {
                $botResponse = $data['data']['reply'];
            }

            if (!$botResponse) {
                return response()->json([
                    'success' => false,
                    'message' => 'A IA não retornou uma resposta válida. Tente novamente.',
                    'debug' => config('app.debug') ? $data : null,
                ], 502);
            }
            
            return response()->json([
                'success' => true,
                'response' => $botResponse,
                'user_id' => $userId,
            ]);
        } catch (Throwable $e) {
            Log::error('Erro ao enviar mensagem para o chatbot: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar sua pergunta. Por favor, tente novamente.',
            ], 500);
        }
    }

    private function buildContextualMessage(string $message, array $conversation): string
    {
        if (empty($conversation)) {
            return $message;
        }

        $recentMessages = array_slice($conversation, -10);

        $context = "Histórico da conversa:\n";
        foreach ($recentMessages as $msg) {
            $role = $msg['user'] ?? 'Desconhecido';
            $content = $msg['content'] ?? '';
            $context .= "- {$role}: {$content}\n";
        }
        $context .= "\nNova pergunta: {$message}";

        return $context;
    }
}
