<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Mensagem de Contato</title>
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
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            font-size: 24px;
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
        .message-header {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .message-header h2 {
            font-size: 16px;
            color: #0056b3;
            margin: 0 0 5px 0;
        }
        .message-header p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }
        .contact-details {
            margin-bottom: 30px;
        }
        .detail-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .detail-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 14px;
            color: #333;
        }
        .subject-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .subject-title {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .subject-text {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
        .message-section {
            margin-top: 20px;
        }
        .message-title {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .message-content {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 15px;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .action-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 30px;
            border-radius: 4px;
        }
        .action-box p {
            font-size: 14px;
            color: #856404;
            margin: 0;
            line-height: 1.6;
        }
        .action-box strong {
            display: block;
            margin-bottom: 5px;
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
            <h1>📬 Nova Mensagem de Contato</h1>
            <p>Porto Shop</p>
        </div>

        <div class="content">
            <div class="message-header">
                <h2>Você recebeu uma nova mensagem</h2>
                <p>Alguém entrou em contato através do formulário de contato do seu portfólio</p>
            </div>

            <div class="contact-details">
                <div class="detail-item">
                    <div class="detail-label">Nome</div>
                    <div class="detail-value">{{ $dto->name }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">E-mail</div>
                    <div class="detail-value">
                        <a href="mailto:{{ $dto->email }}" style="color: #007bff; text-decoration: none;">
                            {{ $dto->email }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="subject-box">
                <div class="subject-title">Assunto</div>
                <div class="subject-text">{{ $dto->subject }}</div>
            </div>

            <div class="message-section">
                <div class="message-title">Mensagem</div>
                <div class="message-content">{{ $dto->message }}</div>
            </div>

            <div class="action-box">
                <strong>💡 Dica:</strong>
                <p>Clique no e-mail acima para responder diretamente ao remetente. Uma cópia de confirmação foi enviada para o e-mail dele.</p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Porto Shop &mdash; Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
