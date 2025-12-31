<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Dashboard - Porto Shop</title>
    <link rel="icon" href="{{ asset('assets/img/branding/porto-shop-branding.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app/scrollbar.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app/pagination.css') }}">
    @yield('styles')
</head>

<body>
    @include('components.app.sidebar')
    <div class="main-content">
        <div class="dashboard-header">
            <div class="app-title">@yield('title')</div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-semibold text-main bold">
                        {{ Auth::user()->userDetail->name_and_surname }}
                    </span>
                    <span class="rounded-avatar border-main">
                        @if(Auth::user()->userDetail->image)
                            <img src="{{ Storage::url(Auth::user()->userDetail->image) }}" alt="Perfil" class="rounded-avatar-img">
                        @else
                            <i class="bi bi-person-fill text-primary-main" style="font-size:1.5rem;"></i>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        @yield('script-before')
        @yield('content')
    </div>
    @include('components.app.footer')
    @include('components.confirm-modal')
    
    <!-- Modals Container -->
    <div id="modals-container"></div>
    
    @yield('scripts-after')
</body>

</html>
