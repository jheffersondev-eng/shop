<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Porto Shop</title>
    <link rel="icon" href="assets/img/porto-shop-logo.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6c63ff;
            --secondary: #38b2ac;
            --bg-gradient: linear-gradient(120deg, #6c63ff 0%, #38b2ac 100%);
            --card-radius: 20px;
            --shadow: 0 8px 32px rgba(44,62,80,0.10);
        }
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Montserrat', 'Roboto', 'Kanit', Arial, sans-serif;
            background: #f4f8fb;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 2px 12px rgba(44,62,80,0.07);
            padding: 0.7rem 0;
            z-index: 1;
        }
        .navbar-brand {
            font-family: 'Kanit', Arial, sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #6c63ff !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-link, .btn-feedback {
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary) !important;
            margin-right: 18px;
        }
        .nav-link:focus, .btn:focus {
            outline: 2px solid var(--secondary);
            outline-offset: 2px;
        }
        .btn-feedback {
            background: var(--primary);
            color: #fff !important;
            border-radius: 22px;
            padding: 7px 22px;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            transition: background 0.2s;
        }
        .btn-feedback:hover, .btn-feedback:focus {
            background: #4834d4;
        }
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-gradient);
            position: relative;
            min-height: 400px;
        }
        .hero-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 20px 40px 20px;
        }
        .hero-text {
            flex: 1;
            color: #222;
            z-index: 1;
            min-width: 260px;
            max-width: 480px; /* garante agrupamento do texto */
            margin: 0 auto;
        }
        .hero-title {
            font-family: 'Montserrat', Arial, sans-serif;
            font-size: 2rem; /* diminuído */
            font-weight: 700;
            color: #fff;
            margin-bottom: 14px;
            line-height: 1.1;
            text-shadow: 0 2px 8px rgba(44,62,80,0.10);
        }
        /* Adicione contraste ao nome na hero */
        .hero-title span {
            color: #fff !important;
            text-shadow: 0 2px 8px rgba(44,62,80,0.18);
        }
        .hero-desc {
            font-size: 1.08rem;
            color: #f4f8fb;
            margin-bottom: 32px;
            line-height: 1.5;
            font-family: 'Roboto', Arial, sans-serif;
            text-shadow: 0 2px 8px rgba(44,62,80,0.10);
        }
        .hero-actions {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }
        .hero-actions .btn {
            min-width: 130px;
            font-size: 1.08rem;
            font-weight: 600;
            padding: 12px 0;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(56,178,172,0.12);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .hero-actions .btn-info {
            background: linear-gradient(90deg, var(--primary) 60%, var(--secondary) 100%);
            border: none;
        }
        .hero-actions .btn-info:hover, .hero-actions .btn-info:focus {
            background: linear-gradient(90deg, var(--secondary) 60%, var(--primary) 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(56,178,172,0.18);
        }
        .hero-actions .btn-outline-info {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: #fff;
        }
        .hero-actions .btn-outline-info:hover, .hero-actions .btn-outline-info:focus {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 16px rgba(56,178,172,0.18);
        }
        .hero-image {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-width: 180px;
        }
        .mockup-bg {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, var(--primary) 70%, var(--secondary) 100%);
            border-radius: 50%;
            z-index: 0;
            opacity: 0.18;
        }
        .mockup-img {
            position: relative;
            z-index: 1;
            width: 220px;
            max-width: 90vw;
            border-radius: 32px;
            box-shadow: var(--shadow);
            background: #fff;
            transition: transform 0.3s;
        }
        .mockup-img:hover, .mockup-img:focus {
            transform: scale(1.05) rotate(-2deg);
        }
        .features-section {
            background: #fff;
            padding: 64px 0 32px 0;
        }
        .features-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 40px;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .features-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 48px;
            max-width: 900px;
            margin: 0 auto;
        }
        .feature-item {
            flex: 1 1 220px;
            max-width: 260px;
            text-align: center;
            background: #f4f8fb;
            border-radius: var(--card-radius);
            box-shadow: 0 2px 12px rgba(44,62,80,0.06);
            padding: 28px 18px 18px 18px;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .feature-item:hover, .feature-item:focus {
            box-shadow: 0 8px 32px rgba(44,62,80,0.14);
            transform: translateY(-4px) scale(1.03);
        }
        .feature-icon {
            font-size: 2.8rem;
            color: var(--primary);
            margin-bottom: 12px;
        }
        .feature-title {
            font-size: 1.18rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 8px;
        }
        .feature-desc {
            font-size: 1rem;
            color: #555;
        }
        .footer {
            text-align: center;
            color: #4a5568;
            font-size: 0.98rem;
            padding: 18px 0 10px 0;
            font-family: 'Roboto', Arial, sans-serif;
            opacity: 0.8;
            background: #fff;
            box-shadow: 0 -2px 12px rgba(44,62,80,0.04);
        }
        /* Responsividade */
        @media (max-width: 900px) {
            .hero-content {
                gap: 32px;
                padding: 32px 8px 24px 8px;
                max-width: 100vw;
            }
            .hero-text {
                max-width: 98vw;
                width: 100%;
                margin: 0 auto 12px auto;
                text-align: center;
            }
            .hero-image {
                width: 100%;
                justify-content: center;
                margin-top: 0;
                min-width: 0;
            }
            .features-list {
                gap: 24px;
            }
        }
        @media (max-width: 650px) {
            .hero-content {
                flex-direction: column;
                gap: 24px;
            }
            .hero-text {
                margin-bottom: 12px;
            }
        }
        @media (min-width: 601px) and (max-width: 650px) {
            .hero-content {
                flex-direction: row;
                gap: 24px;
                padding: 24px 4px 18px 4px;
            }
            .hero-text, .hero-image {
                width: 50%;
                max-width: none;
                min-width: 0;
                margin: 0;
            }
        }
        @media (max-width: 600px) {
            .hero-title {
                font-size: 1.3rem;
            }
            .mockup-img {
                width: 120px;
            }
            .mockup-bg {
                width: 120px;
                height: 120px;
            }
            .features-title {
                font-size: 1.2rem;
            }
            .feature-item {
                padding: 18px 6px 12px 6px;
            }
            .hero-text {
                margin-top: 95px;
            }
        }
        @media (min-width: 502px) and (max-width: 600px) {
            .hero-title {
                font-size: 2.3rem;
            }
            .hero-actions {
                justify-content: center;
            }
            .hero-desc {
                width: 100%;
                text-align: center;
                margin-left: 0;
                margin-right: 0;
            }
        }
        @media (max-width: 501px) {
            .hero-actions {
                justify-content: center;
            }
            .hero-desc {
                width: 100%;
                text-align: center;
                margin-left: 0;
                margin-right: 0;
            }
        }
        @media (max-width: 400px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            .hero-title {
                font-size: 1rem;
            }
        }
    </style>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" aria-label="Menu principal">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/porto-shop-logo.png" alt="Logo Porto Shop" width="38" height="38">
                Porto Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Remova ms-auto d-lg-flex do collapse -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Produtos</a></li>
                </ul>
                <a class="btn-feedback ms-lg-3 mt-2 mt-lg-0" href="#">Ofertas</a>
            </div>
        </div>
    </nav>
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-title">Compre com facilidade e segurança na <span>Porto Shop</span></div>
                <div class="hero-desc">
                    Produtos de qualidade, entrega rápida e ofertas exclusivas.<br>
                </div>
                <div class="hero-actions">
                    <a class="btn btn-info" href="/login" tabindex="0">Entrar</a>
                    <a class="btn btn-outline-info" href="/register" tabindex="0">Cadastre-se</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="mockup-bg"></div>
                <img class="mockup-img" src="assets/img/porto-shop-logo.png" alt="Porto Shop Mockup" tabindex="0">
            </div>
        </div>
    </section>
    <section class="features-section">
        <div class="features-title">Por que escolher a Porto Shop?</div>
        <div class="features-list">
            <div class="feature-item" tabindex="0">
                <div class="feature-icon"><i class="bi bi-phone"></i></div>
                <div class="feature-title">Compra Fácil</div>
                <div class="feature-desc">Interface intuitiva para você comprar sem complicação, direto do seu celular ou computador.</div>
            </div>
            <div class="feature-item" tabindex="0">
                <div class="feature-icon"><i class="bi bi-truck"></i></div>
                <div class="feature-title">Entrega Rápida</div>
                <div class="feature-desc">Receba seus produtos em casa com agilidade e segurança.</div>
            </div>
            <div class="feature-item" tabindex="0">
                <div class="feature-icon"><i class="bi bi-gift"></i></div>
                <div class="feature-title">Ofertas Exclusivas</div>
                <div class="feature-desc">Aproveite promoções especiais e descontos para clientes cadastrados.</div>
            </div>
            <div class="feature-item" tabindex="0">
                <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                <div class="feature-title">Compra Segura</div>
                <div class="feature-desc">Ambiente protegido para garantir a sua privacidade e segurança.</div>
            </div>
        </div>
    </section>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
