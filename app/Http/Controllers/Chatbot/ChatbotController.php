<?php

namespace App\Http\Controllers\Chatbot;

use App\Http\Requests\Chatbot\ChatbotRequest;
use App\Services\Chatbot\IChatbotService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use \Illuminate\Http\Client\ConnectionException;

class ChatbotController
{
    public function __construct(
        private IChatbotService $chatbotService
    ) {}

    public function send(ChatbotRequest $request)
    {
        try {
            $botResponse = $this->chatbotService->send($request->getDto(), Auth::id());
            
            return $botResponse;
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $e->errors(),
            ], 422);

        } catch (ConnectionException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível conectar com o serviço de IA. Verifique sua conexão de internet.',
            ], 503);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar sua pergunta. Tente novamente.',
            ], 500);
        }
    }
}

