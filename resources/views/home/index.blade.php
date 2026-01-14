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
        <li class="nav-item"><a class="nav-link" target="_blank" href="{{ route('documentation.index') }}">Documentação</a></li>
    </ul>
    <a class="btn-feedback ms-lg-3 mt-2 mt-lg-0" href="{{ route('about') }}">Sobre Mim </a>
@endsection
@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-title">Compre com facilidade e segurança na <span>Porto Shop</span></div>
                <div class="hero-desc">
                    Projeto desenvolvido para demonstrar habilidades técnicas, arquitetura e boas práticas no
                    desenvolvimento web.<br>
                </div>
                <div class="hero-actions">
                    <a class="btn btn-info" href="{{ route('login') }}" tabindex="0">Entrar</a>
                    <a class="btn btn-outline-info" href="{{ route('register.create') }}" tabindex="0">Cadastre-se</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="mockup-bg"></div>
                <img class="mockup-img" src="{{ asset('assets/img/branding/porto-shop-branding.png') }}"
                    alt="Porto Shop Mockup" tabindex="0">
            </div>
        </div>
    </section>
    <section class="features-section">
        <div class="features-title">Por que escolher a Porto Shop?</div>
        <div class="features-list">
            <div class="feature-item" tabindex="0">
                <div class="feature-icon"><i class="bi bi-phone"></i></div>
                <div class="feature-title">Compra Fácil</div>
                <div class="feature-desc">Interface intuitiva para você comprar sem complicação, direto do seu celular ou
                    computador.</div>
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
@endsection
