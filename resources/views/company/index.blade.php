@php
    use App\Helpers\DocumentHelper;
    use App\Helpers\PhoneHelper;
    use Carbon\Carbon;
    use App\Helpers\ButtonHelper;
@endphp
@extends('components.app.app')

@section('title', 'Minha Loja')

@section('content')
    @if (!$company)
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">
            <div class="hero-section w-100"
                style="background: var(--bg-gradient, linear-gradient(120deg, #6c63ff 0%, #38b2ac 100%)); border-radius: 24px; box-shadow: 0 8px 32px rgba(44,62,80,0.10);">
                <div class="hero-content flex-column flex-md-row align-items-center w-100">
                    <div class="hero-text text-center mb-4 mb-md-0">
                        <h1 class="hero-title mb-3"
                            style="font-size:2.2rem; font-weight:700; color:#fff; text-shadow:0 2px 8px rgba(44,62,80,0.10);">
                            Crie sua loja e comece a vender seus produtos hoje mesmo
                        </h1>
                        <p class="hero-desc mb-4" style="font-size:1.15rem; color:#f4f8fb;">
                            Com poucos cliques, você terá sua loja online pronta para vender.<br>
                            Clique no botão abaixo para começar!
                        </p>
                        <div class="position-relative d-inline-block">
                            <a href="{{ route('company.create') }}"
                                class="btn btn-lg btn-info px-5 py-3 fw-bold shadow-lg pulse-btn"
                                style="font-size:1.25rem; border-radius:16px; box-shadow:0 4px 24px rgba(56,178,172,0.18);">
                                <i class="bi bi-shop me-2"></i> Criar minha loja
                            </a>
                        </div>
                        <div class="mt-4 text-white-50 small">
                            <i class="bi bi-info-circle me-1"></i> Após criar sua loja, os dados aparecerão abaixo.
                        </div>
                    </div>
                    <div class="hero-image d-flex flex-column align-items-center justify-content-center w-100 mt-5 mt-md-0"
                        style="max-width:400px;">
                        <!-- Skeleton loaders -->
                        <div class="skeleton skeleton-logo mb-3"></div>
                        <div class="skeleton skeleton-title mb-2"></div>
                        <div class="skeleton skeleton-line mb-2"></div>
                        <div class="skeleton skeleton-line mb-2"></div>
                        <div class="skeleton skeleton-line mb-2"></div>
                        <div class="skeleton skeleton-btn mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .pulse-btn {
                animation: pulse 1.5s infinite;
            }

            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(56, 178, 172, 0.18);
                }

                70% {
                    box-shadow: 0 0 0 16px rgba(56, 178, 172, 0.01);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(56, 178, 172, 0.18);
                }
            }

            .arrow-highlight {
                height: 80px;
            }

            .skeleton {
                background: linear-gradient(90deg, #e0e7ef 25%, #f4f8fb 50%, #e0e7ef 75%);
                background-size: 200% 100%;
                animation: skeleton-loading 1.2s infinite linear;
                border-radius: 12px;
            }

            @keyframes skeleton-loading {
                0% {
                    background-position: 200% 0;
                }

                100% {
                    background-position: -200% 0;
                }
            }

            .skeleton-logo {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                margin: 0 auto;
            }

            .skeleton-title {
                width: 180px;
                height: 24px;
                margin: 0 auto;
            }

            .skeleton-line {
                width: 220px;
                height: 16px;
                margin: 0 auto;
            }

            .skeleton-btn {
                width: 140px;
                height: 38px;
                border-radius: 20px;
                margin: 0 auto;
            }
        </style>
    @else
        <div class="company-profile-dashboard d-flex w-100 min-vh-100"
            style="background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%);">
            <!-- Sidebar elegante -->
            <aside class="company-sidebar d-flex flex-column align-items-center justify-content-start py-5 px-4 shadow-lg"
                style="width:350px; min-width:280px; background:#fff; border-radius:0 32px 32px 0;">
                <div class="mb-4 position-relative">
                    <div class="sidebar-avatar-wrapper position-relative">
                        @if ($company->image)
                            <img src="{{ Storage::url($company->image) }}" alt="Logo da loja"
                                class="img-fluid rounded-circle border border-4 border-white shadow"
                                style="width:120px; height:120px; object-fit:cover; background:#fff;">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-light border border-4 border-white shadow"
                                style="width:120px; height:120px;">
                                <i class="bi bi-shop text-primary" style="font-size:3.5rem;"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="text-center w-100">
                    <div class="fw-bold fs-2 mb-1" style="color:{{ $company->primary_color }}; letter-spacing: 0.5px;">
                        {{ $company->fantasy_name }}
                    </div>
                    <div class="text-muted mb-2" style="font-size:1.1rem;"><strong>{{ $company->legal_name }}</strong></div>
                    <div class="company-desc text-muted mb-3" style="font-size:1rem; text-align: center; min-height: 48px;">
                        {{ $company->description }}</div>
                    <div class="d-flex flex-column align-items-center gap-2 mb-3">
                        <span class="badge status-badge px-4 py-2"
                            style="background:{{ $company->is_active ? $company->primary_color ?? '#22c55e' : '#e11d48' }}; color:#fff; border-radius:12px; font-size:1rem;">
                            <i class="bi {{ $company->is_active ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                            {{ $company->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                        {!! 
                            ButtonHelper::make('Editar loja')
                                ->setLink(route('company.edit'))
                                ->setSize('sm')
                                ->setClass('btn btn-outline-primary px-4 py-2 fw-bold animate-btn')
                                ->setIcon('bi bi-pencil me-2')
                                ->render('link') 
                        !!}
                        {!! 
                            ButtonHelper::make('Excluir loja')
                                ->setType('button')
                                ->setSize('sm')
                                ->setClass('btn btn-outline-danger px-4 py-2 fw-bold animate-btn btn-confirm')
                                ->setTitle('Excluir')
                                ->setDataMethod('DELETE')
                                ->setDataAction(route('company.destroy'))
                                ->setDataTitle('Excluir loja')
                                ->setDataMessage('Deseja realmente excluir esta loja?')
                                ->setIcon('bi bi-trash')
                                ->render('button') 
                        !!}
                    </div>
                </div>
            </aside>
            <!-- Área principal aprimorada -->
            <main class="company-main flex-grow-1 py-5 px-5">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-shop-window text-primary me-2 fs-5"></i>
                                <span class="text-muted small">Nome da loja</span>
                            </div>
                            <div class="fw-bold fs-5">{{ $company->fantasy_name }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-card-heading text-info me-2 fs-5"></i>
                                <span class="text-muted small">Nome fantasia</span>
                            </div>
                            <div class="fw-bold fs-5">{{ $company->legal_name }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope-at text-warning me-2 fs-5"></i>
                                <span class="text-muted small">E-mail</span>
                            </div>
                            <div class="fw-bold fs-5">{{ $company->email }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-geo-alt text-danger me-2 fs-5"></i>
                                <span class="text-muted small">Endereço</span>
                            </div>
                            <div class="fw-bold fs-6">
                                {{ $company->city }} - {{ $company->state }}<br>
                                {{ $company->street }} - N° {{ $company->number }} - {{ $company->neighborhood }}<br>
                                CEP: {{ $company->zip_code }}<br>
                                {{ $company->complement }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-telephone text-success me-2 fs-5"></i>
                                <span class="text-muted small">Telefone</span>
                            </div>
                            <div class="fw-bold fs-5">{{ PhoneHelper::format($company->phone) }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-file-earmark-text text-secondary me-2 fs-5"></i>
                                <span class="text-muted small">Documento</span>
                            </div>
                            <div class="fw-bold fs-5">{{ DocumentHelper::formatCpfCnpj($company->document) }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-globe text-primary me-2 fs-5"></i>
                                <span class="text-muted small">Domínio</span>
                            </div>
                            <div class="fw-bold fs-5">{{ $company->domain ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-event text-info me-2 fs-5"></i>
                                <span class="text-muted small">Fundação</span>
                            </div>
                            <div class="fw-bold fs-5">{{ Carbon::parse($company->created_at)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="company-card card border-0 shadow-lg p-4 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-palette text-purple me-2 fs-5"></i>
                                <span class="text-muted small">Cores da marca</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-2">
                                <span class="badge px-3 py-2"
                                    style="background:{{ $company->primary_color }}; color:#fff; border-radius:8px; font-size:1rem;">Primária</span>
                                <span class="badge px-3 py-2"
                                    style="background:{{ $company->secondary_color }}; color:#fff; border-radius:8px; font-size:1rem;">Secundária</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <style>
            .company-profile-dashboard {
                min-height: 100vh;
                background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%);
            }

            .company-sidebar {
                box-shadow: 0 4px 32px rgba(44, 62, 80, 0.10);
                border-right: 1px solid #f1f5f9;
            }

            .sidebar-avatar-wrapper {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .company-card {
                border-radius: 20px;
                min-height: 130px;
                background: #fff;
                transition: box-shadow 0.2s;
            }

            .company-card:hover {
                box-shadow: 0 8px 32px rgba(44, 62, 80, 0.13);
            }

            .company-card .fw-bold {
                word-break: break-word;
            }

            .company-main {
                background: transparent;
            }

            .company-desc {
                min-height: 48px;
                font-size: 1rem;
                color: #64748b;
            }

            .status-badge {
                font-weight: 600;
                letter-spacing: 0.5px;
                box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
            }

            .animate-btn {
                transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            }

            .animate-btn:hover {
                background: #f1f5f9;
                color: #2563eb;
                box-shadow: 0 4px 16px rgba(56, 178, 172, 0.10);
            }

            .bi-palette.text-purple {
                color: #a78bfa;
            }

            @media (max-width: 991px) {
                .company-sidebar {
                    width: 100%;
                    min-width: 0;
                    border-radius: 0;
                    box-shadow: none;
                    border-right: none;
                }

                .company-profile-dashboard {
                    flex-direction: column;
                }

                .company-main {
                    padding-left: 0;
                }
            }
        </style>
    @endif
@endsection
