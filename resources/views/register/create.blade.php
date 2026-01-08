@php
    use App\Helpers\ButtonHelper;
@endphp
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
    <link rel="stylesheet" href="{{ asset('assets/css/home/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/register.css') }}">
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
                    <li class="nav-item">
                        <a class="nav-link" href="https://wa.me/5579996416903?text=Olá%20Jhefferson,%20estou%20entrando%20em%20contato%20para%20conversar%20sobre%20uma%20oportunidade." target="_blank" rel="noopener noreferrer">Contato</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/">Início</a></li>
                </ul>
                <a class="btn-feedback ms-lg-3 mt-2 mt-lg-0" href="{{ route('login') }}">Entrar</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="register-card">
            <div class="register-title">
                <i class="bi bi-person-plus"></i>
                Cadastre-se
            </div>
            @include('components.message')
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ex.: Maria/Shop Ltda" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="document" class="form-label">Documento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control document-mask" id="document" name="document" placeholder="CPF/CNPJ" value="{{ old('document') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Telefone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="text" class="form-control phone-mask" id="phone" name="phone" placeholder="(00) 00000-0000" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label">Endereço</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Rua/Bairro/Apto." value="{{ old('address') }}">
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
                {!! 
                    ButtonHelper::make('Cadastrar')
                        ->setLink(route('register.store'))
                        ->setType('submit')
                        ->setSize('lg')
                        ->setClass('btn btn-primary')
                        ->render('button') 
                !!}
            </form>
            <a href="{{ route('login') }}" class="register-link">Já tenho cadastro</a>
        </div>
    </main>
    <div class="footer">
        &copy; <?=date('Y')?> Porto Shop &mdash; Todos os direitos reservados.
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/mask/mask.js') }}"></script>
</body>
</html>
