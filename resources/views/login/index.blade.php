<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login - Porto Shop</title>
    <link rel="icon" href="{{ asset('assets/img/branding/porto-shop-logo.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/login.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" aria-label="Menu principal">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo Porto Shop" width="38" height="38">
                Porto Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="https://wa.me/5579996416903?text=Olá%20Jhefferson,%20estou%20entrando%20em%20contato%20para%20conversar%20sobre%20uma%20oportunidade." target="_blank" rel="noopener noreferrer">Contato</a>
                    </li>
                </ul>
                <a class="btn-feedback ms-lg-3 mt-2 mt-lg-0" href="/">Início</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="login-card">
            <div class="login-logo">
                <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo Porto Shop">
            </div>
            <div class="login-title">Faça Login</div>
            @include('components.message')
            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="password" placeholder="Sua senha" required>
                </div>
                <button type="submit" class="btn btn-login">Entrar</button>
            </form>
            <a href="{{ route('register.create') }}" class="login-link">Não tem conta? Cadastre-se</a>
        </div>
    </main>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
