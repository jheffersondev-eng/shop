<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro - Porto Shop</title>
    <link rel="icon" href="{{ asset('assets/img/branding/porto-shop-branding.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .register-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.10);
            max-width: 800px;
            margin: 60px auto;
            padding: 38px 48px 32px 48px;
        }
        .register-title {
            font-size: 2rem;
            font-family: 'Montserrat', Arial, sans-serif;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 28px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .register-title .bi-person-plus {
            font-size: 2.2rem;
            color: var(--primary);
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
            padding: 12px 0;
            font-size: 1.15rem;
            font-weight: 600;
            border: none;
            width: 100%;
            margin-top: 18px;
        }
        .btn-register:hover, .btn-register:focus {
            background: #4834d4;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: var(--primary);
            font-size: 1rem;
            text-decoration: underline;
        }
        .input-group {
            margin-bottom: 18px;
        }
        .input-group-text {
            background: #f7f7f7;
            border: none;
            color: #888;
        }
        .form-control::placeholder {
            color: #888 !important;
            opacity: 0.55 !important;
        }
        @media (max-width: 900px) {
            .register-card {
                max-width: 98vw;
                padding: 24px 8px 16px 8px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" aria-label="Menu principal">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo Porto Shop" width="38" height="38">Porto Shop</a>
        </div>
    </nav>
    <main>
        <div class="register-card">
            <div class="register-title">
                <i class="bi bi-person-plus"></i>
                Cadastre-se
            </div>
            <form method="POST" action="/register">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ex.: Maria/Shop Ltda" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="document" class="form-label">Documento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" id="document" name="document" placeholder="CPF/CNPJ" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Telefone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label">Endereço</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Rua/Bairro/Apto.">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Crie uma senha" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirme sua senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua senha" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-register">Cadastrar</button>
            </form>
            <a href="/login" class="register-link">Já tenho cadastro</a>
        </div>
    </main>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
