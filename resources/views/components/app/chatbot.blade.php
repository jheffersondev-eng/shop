<!-- Marked.js para renderizar Markdown -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<!-- Chatbot Flutuante -->
<div id="chatbot-container" class="chatbot-container">
    <!-- Botão Flutuante -->
    <button id="chatbot-toggle" class="chatbot-toggle" title="Tire sua dúvida">
        <i class="bi bi-robot"></i>
    </button>

    <!-- Janela do Chat -->
    <div id="chatbot-window" class="chatbot-window hidden">
        <!-- Header -->
        <div class="chatbot-header">
            <div class="chatbot-header-left">
                <div class="chatbot-avatar">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <div>
                    <div class="chatbot-title">Porto AI</div>
                    <div class="chatbot-subtitle">Assistente Inteligente</div>
                </div>
            </div>
            <button id="chatbot-close" class="chatbot-close" title="Fechar chat">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Mensagens -->
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="chatbot-welcome">
                <div class="welcome-icon">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <h3>Olá! 👋</h3>
                <p>Sou seu assistente de IA. Como posso ajudá-lo?</p>
                <div class="suggested-questions">
                    <button class="suggested-btn" data-question="Me explique algo">📚 Me explique algo</button>
                    <button class="suggested-btn" data-question="Dê-me uma ideia">🚀 Dê-me uma ideia</button>
                    <button class="suggested-btn" data-question="Escrever algo">✍️ Escrever algo</button>
                </div>
            </div>
        </div>

        <!-- Input -->
        <div class="chatbot-input-container">
            <form id="chatbot-form" class="chatbot-form">
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        id="chatbot-input" 
                        class="chatbot-input" 
                        placeholder="Pergunte-me qualquer coisa..." 
                        autocomplete="off"
                    >
                    <button type="submit" class="chatbot-send" title="Enviar">
                        <i class="bi bi-arrow-right-short"></i>
                    </button>
                </div>
            </form>
            <div class="input-footer">
                <small>Porto AI pode cometer erros. Sempre verifique informações importantes.</small>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const suggestedButtons = document.querySelectorAll('.suggested-btn');

    let isFirstMessage = true;
    let conversationHistory = [];

    // Carregar histórico do sessionStorage (reseta ao atualizar página)
    loadConversationHistory();

    // Toggle chat window
    chatbotToggle.addEventListener('click', function() {
        chatbotWindow.classList.toggle('hidden');
        if (!chatbotWindow.classList.contains('hidden')) {
            chatbotInput.focus();
        }
    });

    // Close chat window
    chatbotClose.addEventListener('click', function() {
        chatbotWindow.classList.add('hidden');
    });

    // Suggested buttons
    suggestedButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const question = this.getAttribute('data-question');
            chatbotInput.value = question;
            chatbotInput.focus();
        });
    });

    // Send message
    chatbotForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = chatbotInput.value.trim();
        if (!message) return;

        // Remove welcome message on first message
        if (isFirstMessage) {
            const welcome = chatbotMessages.querySelector('.chatbot-welcome');
            if (welcome) welcome.remove();
            isFirstMessage = false;
        }

        // Adiciona mensagem do usuário
        addMessage(message, 'user');
        
        // Adicionar ao histórico
        conversationHistory.push({
            role: 'user',
            content: message,
            user: 'Você'
        });

        chatbotInput.value = '';

        // Desabilitar input enquanto processa
        chatbotInput.disabled = true;

        // Simula digitação
        showTypingIndicator();

        try {
            // Enviar para a API Laravel
            const response = await fetch('{{ route("chatbot.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    message: message,
                    conversation: conversationHistory // Enviar histórico para contexto
                })
            });

            if (!response.ok) {
                throw new Error(`Erro ${response.status}`);
            }

            const data = await response.json();
            
            if (!data.success) {
                throw new Error(data.message || 'Erro desconhecido');
            }

            removeTypingIndicator();
            
            const botResponse = data.response;
            addMessage(botResponse, 'bot');
            
            // Adicionar resposta ao histórico
            conversationHistory.push({
                role: 'assistant',
                content: botResponse,
                user: 'Porto AI'
            });

            // Salvar histórico
            saveConversationHistory();

        } catch (error) {
            removeTypingIndicator();
            const errorMessage = 'Desculpe, ocorreu um erro ao processar sua pergunta. Tente novamente.';
            addMessage(errorMessage, 'bot');
            console.error('Erro no chatbot:', error);
        } finally {
            chatbotInput.disabled = false;
            chatbotInput.focus();
        }
    });

    function addMessage(text, sender) {
        const messageWrapper = document.createElement('div');
        messageWrapper.className = `chatbot-message-wrapper ${sender}`;
        
        const messageDiv = document.createElement('div');
        messageDiv.className = `chatbot-message ${sender}-message`;
        
        // Renderizar Markdown para mensagens do bot
        if (sender === 'bot') {
            messageDiv.innerHTML = marked.parse(text);
            messageDiv.classList.add('markdown-content');
        } else {
            messageDiv.textContent = text;
        }
        
        messageWrapper.appendChild(messageDiv);
        chatbotMessages.appendChild(messageWrapper);
        
        // Scroll para a última mensagem
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function showTypingIndicator() {
        const typingWrapper = document.createElement('div');
        typingWrapper.id = 'typing-indicator';
        typingWrapper.className = 'chatbot-message-wrapper bot';
        typingWrapper.innerHTML = `
            <div class="chatbot-message bot-message">
                <div class="typing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;
        chatbotMessages.appendChild(typingWrapper);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function removeTypingIndicator() {
        const typingDiv = document.getElementById('typing-indicator');
        if (typingDiv) {
            typingDiv.remove();
        }
    }

    // Funções para gerenciar histórico
    function saveConversationHistory() {
        // Salvar apenas os últimos 20 itens para não sobrecarregar
        const maxHistory = 20;
        const history = conversationHistory.slice(-maxHistory);
        sessionStorage.setItem('chatbot_conversation', JSON.stringify(history));
    }

    function loadConversationHistory() {
        const saved = sessionStorage.getItem('chatbot_conversation');
        if (saved) {
            conversationHistory = JSON.parse(saved);
        }
    }
});
</script>
