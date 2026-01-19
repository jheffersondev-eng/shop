@php
    use App\Helpers\ButtonHelper;
@endphp
<div class="container-fluid px-4">
    @include('components.message')
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="d-inline-block position-relative" style="width: 140px; height: 140px;">
                            <img id="companyLogoPreview" 
                                src="{{ isset($company) && $company->image ? Storage::url($company->image) : '' }}" 
                                class="rounded-circle w-100 h-100 border border-3 border-light shadow-sm bg-white"
                                style="object-fit: cover; display: block; background: #f8f9fa;">
                        <label for="company_logo_input" 
                               class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle"
                               style="cursor: pointer; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera"></i>
                        </label>
                        <input type="file"
                               id="company_logo_input" 
                               name="image"
                               class="d-none" 
                               accept="image/*">
                    </div>
                    <div class="form-text mt-2 mb-3">Logo da loja</div>
                    <div class="row g-2 justify-content-center">
                        <div class="col-6">
                            <label for="primary_color" class="form-label">Cor principal</label>
                            <input type="color" class="form-control form-control-color w-100" id="primary_color" name="primary_color" value="{{ old('primary_color', $company->primary_color ?? '#6c63ff') }}" title="Escolha a cor principal">
                        </div>
                        <div class="col-6">
                            <label for="secondary_color" class="form-label">Cor secundária</label>
                            <input type="color" class="form-control form-control-color w-100" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $company->secondary_color ?? '#38b2ac') }}" title="Escolha a cor secundária">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="fantasy_name" class="form-label">Nome Fantasia <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shop"></i></span>
                                <input type="text" class="form-control" id="fantasy_name" name="fantasy_name" placeholder="Nome fantasia" value="{{ old('fantasy_name', $company->fantasy_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="document" class="form-label">CNPJ <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-123"></i></span>
                                <input type="text" class="form-control document-mask" id="document" name="document" placeholder="00.000.000/0000-00" value="{{ old('document', $company->document ?? '') }}" required>
                            </div>
                        </div>
                        @if(isset($company))
                        <div class="col-md-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select form-control" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $company->is_active) == 1 ? 'selected' : '' }}>Ativa</option>
                                <option value="0" {{ old('is_active', $company->is_active) == 0 ? 'selected' : '' }}>Inativa</option>
                            </select>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <label for="legal_name" class="form-label">Razão Social</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="legal_name" name="legal_name" placeholder="Razão social" value="{{ old('legal_name', $company->legal_name ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="contato@sualoja.com" value="{{ old('email', $company->email ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="text" class="form-control phone-mask" id="phone" name="phone" placeholder="(00) 00000-0000" value="{{ old('phone', $company->phone ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="domain" class="form-label">Domínio</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                <input type="text" class="form-control" id="domain" name="domain" placeholder="www.sualoja.com" value="{{ old('domain', $company->domain ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="zip_code" class="form-label">CEP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="00000-000" value="{{ old('zip_code', $company->zip_code ?? '') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" class="form-control readonly-disabled" id="state" name="state" placeholder="UF" value="{{ old('state', $company->state ?? '') }}" readonly tabindex="-1">
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">Cidade</label>
                    <input type="text" class="form-control readonly-disabled" id="city" name="city" placeholder="Cidade" value="{{ old('city', $company->city ?? '') }}" readonly tabindex="-1">
                </div>
                <div class="col-md-4">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Bairro" value="{{ old('neighborhood', $company->neighborhood ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="street" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Rua" value="{{ old('street', $company->street ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label for="number" class="form-label">Número</label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="Nº" value="{{ old('number', $company->number ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label for="complement" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complement" name="complement" placeholder="Apto, sala, etc." value="{{ old('complement', $company->complement ?? '') }}">
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description" rows="3" maxlength="255" placeholder="Descreva sua loja..." oninput="autoResizeDescription(); updateDescriptionCount();">{{ old('description', $company->description ?? '') }}</textarea>
                    <div class="form-text text-end"><span id="description-count">0</span>/255 caracteres</div>
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2">
                {!! ButtonHelper::make(isset($company) ? 'Salvar alterações' : 'Criar loja')
                    ->setType('submit')
                    ->setSize('lg')
                    ->setClass('btn btn-primary px-5 py-2')
                    ->render('button') 
                !!}
            </div>
        </div>
    </div>
</div>
<style>
    .readonly-disabled[readonly] {
        background-color: #e9ecef !important;
        color: #6c757d !important;
        cursor: not-allowed !important;
        pointer-events: none;
        opacity: 1;
    }
</style>
@section('scripts-after')
    <script src="{{ asset('assets/js/mask/mask.js') }}"></script>
    <script>
        document.getElementById('company_logo_input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('companyLogoPreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Auto-resize e contador para descrição
        function autoResizeDescription() {
            const textarea = document.getElementById('description');
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
        }
        function updateDescriptionCount() {
            const textarea = document.getElementById('description');
            const count = textarea.value.length;
            document.getElementById('description-count').innerText = count;
            if (count > 255) {
                textarea.value = textarea.value.substring(0, 255);
                document.getElementById('description-count').innerText = 255;
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            autoResizeDescription();
            updateDescriptionCount();
            document.getElementById('description').addEventListener('input', function() {
                autoResizeDescription();
                updateDescriptionCount();
            });
        });

        const zipInput = document.getElementById('zip_code');
        const stateInput = document.getElementById('state');
        const cityInput = document.getElementById('city');
        const streetInput = document.getElementById('street');
        const neighborhoodInput = document.getElementById('neighborhood');

        function setAddressFieldsEnabled(enabled) {
            streetInput.readOnly = !enabled;
            neighborhoodInput.readOnly = !enabled;
        }

        function clearAddressFields() {
            stateInput.value = '';
            cityInput.value = '';
            streetInput.value = '';
            neighborhoodInput.value = '';
            setAddressFieldsEnabled(true);
        }

        function setZipError(show, message = 'CEP não encontrado ou inválido!') {
            if (show) {
                zipInput.classList.add('is-invalid');
                if (!document.getElementById('zip-error')) {
                    const div = document.createElement('div');
                    div.className = 'invalid-feedback';
                    div.id = 'zip-error';
                    div.innerText = message;
                    zipInput.parentNode.appendChild(div);
                }
            } else {
                zipInput.classList.remove('is-invalid');
                const div = document.getElementById('zip-error');
                if (div) div.remove();
            }
        }

        zipInput.addEventListener('blur', function() {
            const cep = zipInput.value.replace(/\D/g, '');
            if (cep.length !== 8) {
                clearAddressFields();
                setZipError(true, 'Digite um CEP válido com 8 dígitos.');
                return;
            }
            setZipError(false);
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        clearAddressFields();
                        setZipError(true);
                        return;
                    }
                    stateInput.value = data.uf || '';
                    cityInput.value = data.localidade || '';
                    streetInput.value = data.logradouro || '';
                    neighborhoodInput.value = data.bairro || '';
                    setAddressFieldsEnabled(true);
                    setZipError(false);
                })
                .catch(() => {
                    clearAddressFields();
                    setZipError(true);
                });
        });

        setAddressFieldsEnabled(true);
    </script>
@endsection
