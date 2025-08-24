<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro - Porto Shop</title>
    <link rel="icon" href="/public/assets/img/branding/porto-shop-logo.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/home/index.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .register-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.10);
            max-width: 400px;
            margin: 60px auto;
            padding: 38px 32px 32px 32px;
        }
        .register-title {
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
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px #6c63ff33;
        }
        .btn-register {
            background: var(--primary);
            color: #fff;
            border-radius: 22px;
            padding: 10px 0;
            font-size: 1.08rem;
            font-weight: 600;
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .btn-register:hover, .btn-register:focus {
            background: #4834d4;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: var(--primary);
            font-size: 1rem;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" aria-label="Menu principal">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="/public/assets/img/branding/porto-shop-logo.png" alt="Logo Porto Shop" width="38" height="38">Porto Shop</a>
        </div>
    </nav>
    <main>
        <div class="register-card">
            <div class="register-title">Cadastre-se na Porto Shop</div>
            <form>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome completo</label>
                    <input type="text" class="form-control" id="nome" placeholder="Seu nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Seu e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Crie uma senha" required>
                </div>
                <button type="submit" class="btn btn-register">Cadastrar</button>
            </form>
            <a href="/login" class="register-link">Já tem conta? Entrar</a>
        </div>
    </main>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
