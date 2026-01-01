<div class="row g-3">
    @php
        $profilePermissions = [];
        
        if (!empty($profile) && !empty($profile->permission)) {
            $profilePermissions = array_map('trim', explode(',', $profile->permission));
        }
        
        if (!empty(old('permissions'))) {
            $profilePermissions = old('permissions');
        }
    @endphp
    <div class="col-md-12">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-puzzle"></i></span>
            <input type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                placeholder="Nome do perfil"
                value="{{ $profile?->name ?? old('name') }}" required>
        </div>
    </div>
    <div class="col-md-12">
        <label for="description" class="form-label">Descrição</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-fonts"></i></span>
            <input type="text" 
                class="form-control" 
                id="description" 
                name="description" 
                placeholder="Descrição do perfil"
                value="{{ $profile?->description ?? old('description') }}">
        </div>
    </div>
    <!-- Permissões Checklist -->
    <div class="col-md-12">
        <label class="form-label">Permissões</label>
        <div class="permissions-accordion">
            @if(!empty($modulesPermissions))
                @foreach($modulesPermissions as $index => $module)
                    @php
                        $actionsWeb = $module->getActionsWeb();
                        $moduleName = $actionsWeb->getName();
                        $actions = $actionsWeb->getActions();
                        $isFirst = $index === 0;
                    @endphp
                    <div class="permission-block card border mb-3">
                        <!-- Header do Accordion -->
                        <div class="card-header bg-light p-0">
                            <div class="d-flex align-items-center justify-content-between p-3">
                                <button 
                                    class="btn btn-link text-start permission-toggle flex-grow-1 text-decoration-none text-dark fw-bold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#module-{{ $index }}"
                                    aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                    aria-controls="module-{{ $index }}">
                                    <i class="bi {{ $isFirst ? 'bi-chevron-down' : 'bi-chevron-right' }} me-2"></i>
                                    {{ $moduleName }}
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-sm btn-outline-primary mark-all-btn"
                                    data-module="{{ $index }}"
                                    title="Marcar todas as permissões deste módulo">
                                    <i class="bi bi-check2-all"></i> Marcar Todos
                                </button>
                            </div>
                        </div>
                        <!-- Conteúdo do Accordion -->
                        <div 
                            id="module-{{ $index }}" 
                            class="collapse {{ $isFirst ? 'show' : '' }}"
                            data-bs-parent=".permissions-accordion">
                            <div class="card-body">
                                <div class="row g-3">
                                    @if(!empty($actions))
                                        @foreach($actions as $action)
                                            @php
                                                $isChecked = in_array(strtolower($action['action']), $profilePermissions);
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input 
                                                        class="form-check-input permission-checkbox" 
                                                        type="checkbox" 
                                                        id="perm-{{ md5($action['action']) }}"
                                                        name="permissions[]"
                                                        value="{{ $action['action'] }}"
                                                        data-module="{{ $index }}"
                                                        {{ $isChecked ? 'checked' : '' }}>
                                                    <label 
                                                        class="form-check-label" 
                                                        for="perm-{{ md5($action['action']) }}">
                                                        {{ $action['name'] }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@yield('actions')