<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Porto Shop</title>
    <link rel="icon" href="{{ asset('assets/img/brandig/porto-shop-branding.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" aria-label="Menu principal">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo Porto Shop" width="38" height="38">
                Porto Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                    <a class="btn btn-info" href="{{ route('login') }}" tabindex="0">Entrar</a>
                    <a class="btn btn-outline-info" href="{{ route('register.create') }}" tabindex="0">Cadastre-se</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="mockup-bg"></div>
                <img class="mockup-img" src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Porto Shop Mockup" tabindex="0">
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
