<ul class="nav nav-tabs" id="editUserTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button"
            role="tab" aria-controls="account" aria-selected="true">Conta</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button"
            role="tab" aria-controls="personal" aria-selected="false">Dados pessoais</button>
    </li>
</ul>
<div class="tab-content p-3 border border-top-0" id="editUserTabContent">
    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="exemplo@dominio.com" value="{{ isset($user) ? $user->email : '' }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="profile_id" class="form-label">Perfil</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <select class="form-select form-control" id="profile_id" name="profile_id" required>
                        <option value="">Selecione</option>
                        @foreach ($profiles->items() ?? [] as $profile)
                            <option value="{{ $profile->id }}"
                                {{ (string) ($user->profile_id ?? '') === (string) $profile->id ? 'selected' : '' }}>
                                {{ $profile->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label for="is_active" class="form-label">Ativo</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                    <select class="form-select form-control" id="is_active" name="is_active" required>
                        <option value="">Selecione</option>
                        @foreach ($isActive ?? [] as $key => $value)
                            <option value="{{ $key }}"
                                {{ $user->is_active ?? '' === $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Senha (deixe em branco para manter)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nova senha">
                </div>
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirme a senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirme a nova senha">
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo"
                        value="{{ old('name', isset($user) ? $user->userDetail->name : '') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="document" class="form-label">Documento</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <input type="text" class="form-control" id="document" name="document" placeholder="CPF/CNPJ"
                        value="{{ old('document', isset($user) ? $user->userDetail->document : '') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="phone" class="form-label">Telefone</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                    <input type="text" class="form-control" id="phone" name="phone"
                        placeholder="(00) 00000-0000" value="{{ old('phone',  isset($user) ? ($user->userDetail)->phone : '') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                        value="{{ \App\Helpers\DateHelper::formatForInput( isset($user) ? ($user->userDetail)->birth_date : '') }}">
                </div>
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Endereço</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Rua/Bairro/Apto." value="{{ old('address',  isset($user) ? ($user->userDetail)->address : '') }}">
                </div>
            </div>
        </div>
    </div>
</div>
@yield('actions')
