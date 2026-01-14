@extends('components.app.home-app')
@section('menu')
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Início</a></li>
        <li class="nav-item">
            <a class="nav-link"
                href="https://wa.me/5579996416903?text=Olá%20Jhefferson,%20estou%20entrando%20em%20contato%20para%20conversar%20sobre%20uma%20oportunidade."
                target="_blank" rel="noopener noreferrer">Contato</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('shortly') }}">Produtos</a></li>
        <li class="nav-item"><a class="nav-link" target="_blank" href="{{ route('documentation.index') }}">Documentação</a>
        </li>
    </ul>
    <a class="btn-feedback ms-lg-3 mt-2 mt-lg-0" href="{{ route('about') }}">Sobre Mim </a>
@endsection
@section('heads')
    <link rel="stylesheet" href="{{ asset('assets/css/home/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/login.css') }}">
@endsection
@section('content')
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
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail"
                        required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="password" placeholder="Sua senha"
                        required>
                </div>
                <button type="submit" class="btn btn-login">Entrar</button>
            </form>
            <a href="{{ route('register.create') }}" class="login-link">Não tem conta? Cadastre-se</a>
        </div>
    </main>
@endsection
