<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Recebimento - Porto Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            font-size: 28px;
            margin: 0;
        }
        .header p {
            margin-top: 5px;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .greeting strong {
            color: #28a745;
        }
        .confirmation-box {
            background-color: #e8f5e9;
            border: 2px solid #28a745;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .confirmation-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .confirmation-title {
            font-size: 18px;
            color: #1e7e34;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .confirmation-text {
            font-size: 14px;
            color: #2e7d32;
        }
        .message-summary {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .summary-title {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .summary-item {
            margin-bottom: 10px;
            font-size: 14px;
        }
        .summary-item label {
            color: #666;
            font-weight: 600;
        }
        .summary-item value {
            color: #333;
            display: block;
            margin-left: 0;
        }
        .what-happens {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .what-happens-title {
            font-size: 14px;
            color: #856404;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .what-happens-title i {
            margin-right: 8px;
        }
        .what-happens-list {
            font-size: 14px;
            color: #856404;
            line-height: 1.8;
        }
        .what-happens-list ol {
            margin: 10px 0 0 20px;
            padding-left: 10px;
        }
        .what-happens-list li {
            margin-bottom: 8px;
        }
        .next-steps {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .next-steps-title {
            font-size: 14px;
            color: #0056b3;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .next-steps p {
            font-size: 14px;
            color: #004085;
            line-height: 1.6;
            margin: 0;
        }
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 20px 0;
        }
        .closing-message {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-top: 20px;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Mensagem Recebida!</h1>
            <p>Porto Shop - Obrigado por Entrar em Contato</p>
        </div>

        <div class="content">
            <div class="greeting">
                Olá <strong>{{ $dto->name }}</strong>! 👋
            </div>

            <div class="confirmation-box">
                <div class="confirmation-icon">✓</div>
                <div class="confirmation-title">Recebemos sua mensagem com sucesso!</div>
                <div class="confirmation-text">Analisaremos sua proposta e entraremos em contato em breve</div>
            </div>

            <div class="what-happens">
                <div class="what-happens-title">
                    ⏱️ O que acontece agora?
                </div>
                <div class="what-happens-list">
                    <ol>
                        <li><strong>Revisão da proposta:</strong> Vou analisar sua mensagem e interesse cuidadosamente</li>
                        <li><strong>Resposta rápida:</strong> Comprometo-me em responder no máximo em <strong>48 horas úteis</strong></li>
                        <li><strong>Próximos passos:</strong> Definiremos a melhor forma de prosseguir conforme sua necessidade</li>
                    </ol>
                </div>
            </div>

            <div class="message-summary">
                <div class="summary-title">📋 Resumo da sua mensagem</div>
                <div class="summary-item">
                    <label>Assunto:</label>
                    <value>{{ $dto->subject }}</value>
                </div>
                <div style="height: 1px; background-color: #dee2e6; margin: 10px 0;"></div>
                <div class="summary-item">
                    <label>E-mail para contato:</label>
                    <value>{{ $dto->email }}</value>
                </div>
            </div>

            <div class="next-steps">
                <div class="next-steps-title">💡 Dicas importantes:</div>
                <p>
                    <strong>Não recebeu resposta?</strong> Verifique sua pasta de SPAM ou LIXO. 
                    Se não encontrar, entre em contato novamente através deste formulário.
                </p>
            </div>

            <div class="closing-message">
                <p>
                    Agradeço genuinamente por sua interessar em conversar sobre oportunidades de colaboração ou emprego. 
                    Seu interesse é importante para mim, e vou dedicar tempo necessário para analisar sua proposta com atenção.
                </p>
                <p style="margin-top: 15px;">
                    Caso você tenha informações adicionais ou documentos para compartilhar, pode respondê-los quando receber 
                    meu retorno.
                </p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Porto Shop &mdash; Todos os direitos reservados.</p>
            <p style="margin-top: 10px;">
                Dúvidas? <a href="mailto:jhefferson.tec@gmail.com">Entre em contato conosco</a>
            </p>
        </div>
    </div>
</body>
</html>
