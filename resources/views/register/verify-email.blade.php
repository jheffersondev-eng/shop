@php
    use App\Helpers\ButtonHelper;
@endphp
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Verificar E-mail - Porto Shop</title>
    <link rel="icon" href="{{ asset('assets/img/branding/porto-shop-branding.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/home/login.css') }}">
    <style>
        .verify-card {
            max-width: 400px;
            margin: 80px auto;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .verify-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .verify-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .code-input {
            font-size: 18px;
            letter-spacing: 5px;
            text-align: center;
            font-weight: 600;
        }

        .verify-link {
            text-align: center;
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .verify-link:hover {
            text-decoration: underline;
        }

        .alert-info {
            background-color: #e7f3ff;
            border-color: #b3d9ff;
            color: #004085;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            color: #666;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
        }

        body {
            padding-bottom: 60px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Ofertas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Início</a></li>
                </ul>
                <a class="btn-feedback ms-lg-3 mt-2 mt-lg-0" href="{{ route('login') }}">Entrar</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="verify-card">
            <div class="verify-title">
                <i class="bi bi-shield-check"></i>
                Verificar E-mail
            </div>
            <div class="verify-subtitle">
                Enviamos um código de 6 dígitos para {{ $email }}
            </div>

            @include('components.message')

            <div class="alert-info">
                <i class="bi bi-info-circle"></i> Digite o código recebido no seu e-mail. O código é válido por 30 minutos.
            </div>

            <form method="POST" action="{{ route('register.verify-email') }}">
                @csrf
                <div class="mb-3">
                    <label for="verification_code" class="form-label">Código de Verificação</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input 
                            type="text" 
                            class="form-control code-input @error('verification_code') is-invalid @enderror" 
                            id="verification_code" 
                            name="verification_code" 
                            placeholder="000000" 
                            maxlength="6"
                            pattern="[0-9]{6}"
                            inputmode="numeric"
                            value="{{ old('verification_code') }}"
                            required
                            autofocus
                        >
                        @error('verification_code')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{ $userId }}">

                {!! 
                    ButtonHelper::make('Verificar E-mail')
                        ->setLink(route('register.verify-email'))
                        ->setType('submit')
                        ->setSize('lg')
                        ->setClass('btn btn-primary w-100')
                        ->render('button') 
                !!}
            </form>

            <a href="{{ route('register.create') }}" class="verify-link">Não recebeu o código? Cadastre-se novamente</a>
        </div>
    </main>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Permitir apenas números no input de código
        document.getElementById('verification_code').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>
