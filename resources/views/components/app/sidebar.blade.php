@php
    use App\Modules\Config\Configuration;
    use Illuminate\Support\Facades\Auth;
    $modules = Configuration::getMenu();
@endphp
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo" width="38" height="38">
    </div>
    <nav class="sidebar-nav">
        @foreach ($modules as $module)
            @if($module->getPermission() && !Auth::user()->hasPermission($module->getPermission()))
                @continue
            @endif
            @if (!$module->hasSubMenu())
                <a href="{{ $module->getLink() }}" class="nav-link sidebar-item" title="{{ $module->getName() }}">
                    <span class="sidebar-icon"><i class="{{ $module->getIcon() }}"></i></span>
                    <span class="sidebar-label">{{ $module->getName() }}</span>
                </a>
            @else
                <!-- Grupo de rotas com submenu -->
                <div class="sidebar-group">
                    <button type="button" class="nav-link sidebar-item sidebar-group-toggle"
                        title="{{ $module->getName() }}">
                        <span class="sidebar-icon"><i class="{{ $module->getIcon() }}"></i></span>
                        <span class="sidebar-label">{{ $module->getName() }}</span>
                        <span class="sidebar-chevron"><i class="bi bi-chevron-down ms-auto"></i></span>
                    </button>
                    @foreach ($module->getSubMenu() as $subMenu)
                        @if($subMenu->getPermission() && !Auth::user()->hasPermission($subMenu->getPermission()))
                            @continue
                        @endif
                        <div class="sidebar-submenu">
                            <a href="{{ $subMenu->getLink() }}" class="nav-link sidebar-subitem"
                                title="{{ $subMenu->getName() }}">
                                <span class="sidebar-icon"><i class="{{ $subMenu->getIcon() }}"></i></span>
                                <span class="sidebar-label">{{ $subMenu->getName() }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </nav>
</div>
