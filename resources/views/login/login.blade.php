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
    <style>
        /* Sobrescreve apenas o necessário para o login */
        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .login-card {
            background: #fff;
            border-radius: var(--card-radius);
            box-shadow: var(--shadow);
            max-width: 400px;
            margin: 60px auto;
            padding: 38px 32px 32px 32px;
            position: relative;
            z-index: 1;
        }
        .login-title {
            font-size: 1.7rem;
            font-family: 'Montserrat', Arial, sans-serif;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 18px;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
            color: #222;
            font-size: 0.93rem; /* diminui a fonte */
        }
        .form-control {
            height: 52px; /* aumenta a altura */
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px #6c63ff33;
        }
        .btn-login {
            background: var(--primary);
            color: #fff;
            border-radius: 22px;
            padding: 10px 0;
            font-size: 1.08rem;
            font-weight: 600;
            border: none;
            width: 100%;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-login:hover, .btn-login:focus {
            background: #4834d4;
        }
        .login-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: var(--primary);
            font-size: 1rem;
            text-decoration: underline;
        }
        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 18px;
        }
        .login-logo img {
            width: 54px;
            height: 54px;
            border-radius: 16px;
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
            margin-top: auto;
        }
        @media (max-width: 500px) {
            .login-card {
                padding: 18px 8px 18px 8px;
                margin: 32px 8px;
            }
            .login-title {
                font-size: 1.2rem;
            }
        }
    </style>
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
                    <!-- Adicione outros itens de menu aqui se necessário -->
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
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Seu e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Sua senha" required>
                </div>
                <button type="submit" class="btn btn-login">Entrar</button>
            </form>
            <a href="/register" class="login-link">Não tem conta? Cadastre-se</a>
        </div>
    </main>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
