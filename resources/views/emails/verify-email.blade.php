<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifique seu E-mail</title>
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
        .header img {
            height: 40px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            margin: 10px 0 0 0;
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
            color: #007bff;
        }
        .message {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .code-box {
            background-color: #f0f8ff;
            border: 2px solid #007bff;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .code-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .code {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .code-expiry {
            font-size: 12px;
            color: #ff6b6b;
            margin-top: 10px;
            font-weight: 500;
        }
        .instructions {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #856404;
        }
        .instructions strong {
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
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Porto Shop</h1>
            <p style="margin-top: 5px; font-size: 14px;">Verifique seu E-mail</p>
        </div>

        <div class="content">
            <div class="greeting">
                Olá <strong>{{ $user->name }}</strong>! 👋
            </div>

            <div class="message">
                Obrigado por se cadastrar na <strong>Porto Shop</strong>. Para completar seu registro e ativar sua conta, você precisa verificar seu endereço de e-mail.
            </div>

            <div class="instructions">
                <strong>⏱️ Seu código é válido por 30 minutos</strong>
                Use o código abaixo na página de verificação:
            </div>

            <div class="code-box">
                <div class="code-label">Código de Verificação</div>
                <div class="code">{{ $verificationCode }}</div>
                <div class="code-expiry">Válido até {{ $user->verification_expires_at->format('d/m/Y \à\s H:i') }}</div>
            </div>

            <div class="message">
                <strong>Como proceder:</strong><br>
                1. Acesse a página de verificação de e-mail<br>
                2. Digite o código de 6 dígitos acima<br>
                3. Clique em "Verificar E-mail"<br>
                4. Pronto! Sua conta estará ativa
            </div>

            <div class="divider"></div>

            <div class="message" style="font-size: 12px; color: #999;">
                ⚠️ <strong>Segurança:</strong> Se você não solicitou este e-mail, por favor ignore-o ou entre em contato com nosso suporte.
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Porto Shop &mdash; Todos os direitos reservados.</p>
            <p style="margin-top: 10px;">
                Dúvidas? <a href="mailto:suporte@portoshop.com">Entre em contato conosco</a>
            </p>
        </div>
    </div>
</body>
</html>
