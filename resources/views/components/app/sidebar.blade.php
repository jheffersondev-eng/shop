
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo" width="38" height="38">
    </div>
    <nav class="sidebar-nav">
        <a href="#" class="nav-link active sidebar-item" title="Dashboard">
            <span class="sidebar-icon"><i class="bi bi-grid"></i></span>
            <span class="sidebar-label">Dashboard</span>
        </a>
        <a href="#" class="nav-link sidebar-item" title="Usuários">
            <span class="sidebar-icon"><i class="bi bi-people"></i></span>
            <span class="sidebar-label">Usuários</span>
        </a>
        <a href="#" class="nav-link sidebar-item" title="Produtos">
            <span class="sidebar-icon"><i class="bi bi-box"></i></span>
            <span class="sidebar-label">Produtos</span>
        </a>
        <a href="#" class="nav-link sidebar-item" title="Vendas">
            <span class="sidebar-icon"><i class="bi bi-bar-chart"></i></span>
            <span class="sidebar-label">Vendas</span>
        </a>
        <!-- Grupo de rotas com submenu -->
        <div class="sidebar-group">
            <button type="button" class="nav-link sidebar-item sidebar-group-toggle" title="Configurações">
                <span class="sidebar-icon"><i class="bi bi-gear"></i></span>
                <span class="sidebar-label">Configurações</span>
                <span class="sidebar-chevron"><i class="bi bi-chevron-down ms-auto"></i></span>
            </button>
            <div class="sidebar-submenu">
                <a href="#" class="nav-link sidebar-subitem" title="Perfil">
                    <span class="sidebar-icon"><i class="bi bi-person"></i></span>
                    <span class="sidebar-label">Perfil</span>
                </a>
                <a href="#" class="nav-link sidebar-subitem" title="Logout">
                    <span class="sidebar-icon"><i class="bi bi-box-arrow-right"></i></span>
                    <span class="sidebar-label">Logout</span>
                </a>
            </div>
        </div>
    </nav>
</div>