# 🤖 ChatbotKnowledge - Dados do Bot

O bot lê todos os dados de conhecimento deste arquivo:

## 📍 Arquivo de Dados do Bot

```
app/Services/Chatbot/ChatbotKnowledgeBase.php
```

Este arquivo contém TODO o conhecimento que o bot usa para responder:
- ✅ System prompt (instruções)
- ✅ 8 módulos do sistema
- ✅ 16+ FAQ
- ✅ 30+ endpoints API
- ✅ Fluxo de dependências
- ✅ Validações de campos

## 🔄 Como o Bot Usa

```
Usuário faz pergunta
    ↓
ChatbotService carrega ChatbotKnowledgeBase.php
    ↓
Bot monta prompt com:
  • System prompt
  • Módulos
  • FAQ
  • API docs
  • Histórico
    ↓
Envia tudo para IA responder
    ↓
IA responde sobre o Porto Shop
```

## 📝 Estrutura do Arquivo

```php
ChatbotKnowledgeBase::
  getSystemPrompt()          // Instruções ao bot
  getSystemModules()         // Módulos do sistema
  getFAQ()                   // Perguntas e respostas
  getAPIDocumentation()      // Endpoints da API
  buildContextualPrompt()    // Monta tudo junto
```

## ✅ Pronto

O bot está **100% treinado** com todo esse conhecimento. Está pronto para responder qualquer pergunta sobre o Porto Shop e sua API.
