@php
    use App\Helpers\SelectHelper;
    use \App\Helpers\DateHelper;
@endphp
<ul class="nav nav-tabs" id="editUserTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" 
            id="account-tab" 
            data-bs-toggle="tab" 
            data-bs-target="#account" 
            type="button"
            role="tab" 
            aria-controls="account" 
            aria-selected="true">Conta</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" 
            id="personal-tab" 
            data-bs-toggle="tab" 
            data-bs-target="#personal" 
            type="button"
            role="tab" 
            aria-controls="personal" 
            aria-selected="false">Dados pessoais</button>
    </li>
</ul>
<div class="tab-content p-3 border border-top-0" id="editUserTabContent">
    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
        <div class="mb-4 text-center">
            <div class="d-inline-block position-relative" style="width: 150px; height: 150px;">
                <img id="profileImage" 
                    src="{{ asset('storage/' . ($user?->userDetail?->image ?? 'default-profile.png')) }}" 
                    class="rounded-circle w-100 h-100"
                    style="object-fit: cover; border: 3px solid #dee2e6; display: block;">
                <label for="profile_image_input" 
                    class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle"
                    style="cursor: pointer; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-pencil"></i>
                </label>
            </div>
            <input type="file" 
                id="profile_image_input" 
                name="image" 
                class="d-none" 
                accept="image/*">
        </div>
        <div class="row g-3">
            <div class="col-md-12">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" 
                        class="form-control" 
                        id="email" 
                        name="email"
                        placeholder="exemplo@dominio.com" 
                        value="{{ $user?->email ?? old('email') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        placeholder="Nova senha">
                </div>
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirme a senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" 
                        class="form-control" 
                        id="password_confirmation" 
                        name="password_confirmation"
                        placeholder="Confirme a nova senha">
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="name" class="form-label">Nome</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        placeholder="Nome completo"
                        value="{{ $user?->userDetail?->name ?? old('name') }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="document" class="form-label">Documento</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <input type="text" 
                        class="form-control document-mask" 
                        id="document" 
                        name="document" 
                        placeholder="CPF/CNPJ"
                        value="{{ $user?->userDetail?->document ?? old('document') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    <input type="date" 
                        class="form-control" 
                        id="birth_date" 
                        name="birth_date"
                        value="{{ DateHelper::formatForInput( $user?->userDetail?->birth_date ?? old('birth_date') ) }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="phone" class="form-label">Telefone</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                    <input type="text" 
                        class="form-control phone-mask" 
                        id="phone" 
                        name="phone"
                        placeholder="(00) 00000-0000" 
                        value="{{ $user?->userDetail?->phone ?? old('phone') }}">
                </div>
            </div>
            <div class="col-8">
                <label for="address" class="form-label">Endereço</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" 
                        class="form-control" 
                        id="address" 
                        name="address"
                        placeholder="Rua/Bairro/Apto." 
                        value="{{ $user?->userDetail?->address ?? old('address') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@yield('actions')
@section('scripts-after')
    <script src="{{ asset('assets/js/mask/mask.js') }}"></script>
    <script src="{{ asset('assets/js/userProfile/profileImageInput.js') }}"></script>
@endsection