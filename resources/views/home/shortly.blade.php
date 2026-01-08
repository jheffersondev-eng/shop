<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em Breve - Porto Shop</title>
    <link rel="icon" href="{{ asset('assets/img/branding/porto-shop-branding.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --border: #e5e7eb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .coming-soon-container {
            max-width: 900px;
            width: 100%;
            padding: 40px 20px;
        }

        .coming-soon-content {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .coming-soon-logo {
            margin-bottom: 30px;
        }

        .coming-soon-logo img {
            height: 60px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .coming-soon-icon {
            font-size: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 30px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .coming-soon-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .coming-soon-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 15px;
            font-weight: 500;
        }

        .coming-soon-description {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 50px;
            line-height: 1.8;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .feature-item {
            padding: 20px;
            background: var(--bg-light);
            border-radius: 12px;
            border: 2px solid var(--border);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .feature-icon {
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .feature-text {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .email-signup {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 40px;
        }

        .email-signup-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            margin-bottom: 20px;
        }

        .email-input-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .email-input-group input {
            flex: 1;
            min-width: 250px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .email-input-group input::placeholder {
            color: #999;
        }

        .email-input-group button {
            padding: 12px 30px;
            background: white;
            color: #667eea;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .email-input-group button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .social-link {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            color: #667eea;
            font-size: 1.2rem;
            text-decoration: none;
            border: 2px solid var(--border);
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #667eea;
            color: white;
            transform: translateY(-5px);
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .countdown-item {
            text-align: center;
        }

        .countdown-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .countdown-label {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-text {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 30px;
        }

        .footer-text a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Efeito de fundo animado */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: -1;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .coming-soon-content {
                padding: 40px 20px;
            }

            .coming-soon-title {
                font-size: 2rem;
            }

            .coming-soon-subtitle {
                font-size: 1rem;
            }

            .coming-soon-description {
                font-size: 1rem;
            }

            .countdown {
                gap: 15px;
            }

            .countdown-number {
                font-size: 1.8rem;
            }

            .email-input-group {
                flex-direction: column;
            }

            .email-input-group input,
            .email-input-group button {
                width: 100%;
                min-width: auto;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <div class="coming-soon-container">
        <div class="coming-soon-content">
            <!-- Logo -->
            <div class="coming-soon-logo">
                <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Porto Shop">
            </div>

            <!-- Icon -->
            <div class="coming-soon-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <!-- Título -->
            <h1 class="coming-soon-title">Em Breve</h1>
            <p class="coming-soon-subtitle">Porto Shop está sendo preparada</p>

            <!-- Descrição -->
            <p class="coming-soon-description">
                Estamos trabalhando para trazer uma experiência de compra extraordinária. 
                Um novo mundo de possibilidades está chegando em breve. Fique preparado!
            </p>

            <!-- Contagem Regressiva (opcional) -->
            <div class="countdown">
                <div class="countdown-item">
                    <div class="countdown-number" id="days">00</div>
                    <div class="countdown-label">Dias</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="hours">00</div>
                    <div class="countdown-label">Horas</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="minutes">00</div>
                    <div class="countdown-label">Minutos</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="seconds">00</div>
                    <div class="countdown-label">Segundos</div>
                </div>
            </div>

            <!-- Features -->
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-fill"></i>
                    </div>
                    <div class="feature-title">Rápido</div>
                    <div class="feature-text">Experiência de compra instantânea</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="feature-title">Seguro</div>
                    <div class="feature-text">Transações 100% protegidas</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-hand-thumbs-up"></i>
                    </div>
                    <div class="feature-title">Confiável</div>
                    <div class="feature-text">Qualidade garantida sempre</div>
                </div>
            </div>

            <!-- Email Signup -->
            <div class="email-signup">
                <div class="email-signup-title">Seja notificado quando lançarmos!</div>
                <form class="email-input-group" id="notifyForm">
                    <input 
                        type="email" 
                        placeholder="Digite seu email..." 
                        required
                        name="email"
                    >
                    <button type="submit">Notifique-me</button>
                </form>
            </div>

            <!-- Redes Sociais -->
            <div class="social-links">
                <a href="https://github.com/jheffersondev-eng" target="_blank" class="social-link" aria-label="GitHub">
                    <i class="bi bi-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/jhefferson-silva-3013031b1/" target="_blank" class="social-link" aria-label="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://wa.me/5579996416903" target="_blank" class="social-link" aria-label="WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
                <a href="mailto:jhefferson.tec@gmail.com" class="social-link" aria-label="Email">
                    <i class="bi bi-envelope"></i>
                </a>
            </div>

            <!-- Footer -->
            <div class="footer-text">
                <p>Desenvolvido com <i class="bi bi-heart-fill" style="color: #667eea;"></i> por 
                    <a href="/">Jhefferson Matheus</a>
                </p>
                <p style="margin-top: 10px;">© 2026 Porto Shop. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Contagem Regressiva
        function updateCountdown() {
            // Data de lançamento (você pode alterar para a data desejada)
            const launchDate = new Date('2026-03-01T00:00:00').getTime();
            const now = new Date().getTime();
            const distance = launchDate - now;

            if (distance < 0) {
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Formulário de Email
        document.getElementById('notifyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[name="email"]').value;
            
            // Simular notificação
            const button = this.querySelector('button');
            const originalText = button.textContent;
            
            button.textContent = 'Email salvo! ✓';
            button.disabled = true;
            
            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
                this.reset();
            }, 2000);
        });
    </script>
</body>
</html>
