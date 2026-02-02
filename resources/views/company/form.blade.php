@php
    use App\Helpers\ButtonHelper;
@endphp
<div class="container-fluid px-4">
    @include('components.message')
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="row g-4 align-items-stretch">
                <div class="col-md-4 text-center brand-column">
                    <div class="logo-wrapper position-relative">
                            <img id="companyLogoPreview" 
                                src="{{ isset($company) && $company->image ? Storage::url($company->image) : '' }}" 
                                class="rounded-circle w-100 h-100 border border-3 border-light shadow-sm bg-white"
                                style="object-fit: cover; display: block; background: #f8f9fa;">
                        <label for="company_logo_input" 
                               class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle"
                               style="cursor: pointer; width: 40px; height: 40px; padding: 0; margin: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera"></i>
                        </label>
                        <input type="file"
                               id="company_logo_input" 
                               name="image"
                               class="d-none" 
                               accept="image/*">
                    </div>
                    <div class="form-text mt-2 mb-3">Logo da loja</div>
                    <div class="row g-2 justify-content-center w-100">
                        <div class="col-6">
                            <label for="primary_color" class="form-label">Principal</label>
                            <input type="color" class="form-control form-control-color w-100" id="primary_color" name="primary_color" value="{{ old('primary_color', $company->primary_color ?? '#6c63ff') }}" title="Escolha a cor principal">
                        </div>
                        <div class="col-6">
                            <label for="secondary_color" class="form-label">Secundária</label>
                            <input type="color" class="form-control form-control-color w-100" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $company->secondary_color ?? '#38b2ac') }}" title="Escolha a cor secundária">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 d-flex">
                    <div class="banner-preview position-relative border rounded bg-light overflow-hidden w-100">
                        <img id="companyBannerPreview" 
                             src="{{ isset($company) && $company->image_banner ? Storage::url($company->image_banner) : '' }}"
                             alt="Prévia do banner"
                             style="width: 100%; height: 100%; object-fit: cover; display: {{ isset($company) && $company->image_banner ? 'block' : 'none' }};">
                        <span id="companyBannerPlaceholder" class="text-muted" style="{{ isset($company) && $company->image_banner ? 'display: none;' : '' }}">Selecione um banner</span>
                        <label for="image_banner" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle"
                               style="cursor: pointer; width: 44px; height: 44px; padding: 0; margin: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera"></i>
                        </label>
                        <input type="file" class="d-none" id="image_banner" name="image_banner" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-1">
                <div class="col-md-12">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="fantasy_name" class="form-label">Nome Fantasia <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shop"></i></span>
                                <input type="text" class="form-control" id="fantasy_name" name="fantasy_name" placeholder="Nome fantasia" value="{{ old('fantasy_name', $company->fantasy_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="slogan" class="form-label">Slogan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                                <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Slogan" value="{{ old('slogan', $company->slogan ?? '') }}" required>
                            </div>
                        </div>
                        @if(isset($company))
                        <div class="col-md-3">
                            <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                <select class="form-select form-control" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $company->is_active) == 1 ? 'selected' : '' }}>Ativa</option>
                                    <option value="0" {{ old('is_active', $company->is_active) == 0 ? 'selected' : '' }}>Inativa</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-4">
                            <label for="legal_name" class="form-label">Razão Social <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="legal_name" name="legal_name" placeholder="Razão social" value="{{ old('legal_name', $company->legal_name ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="document" class="form-label">CNPJ</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-123"></i></span>
                                <input type="text" class="form-control document-mask" id="document" name="document" placeholder="00.000.000/0000-00" value="{{ old('document', $company->document ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="contato@sualoja.com" value="{{ old('email', $company->email ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="text" class="form-control phone-mask" id="phone" name="phone" placeholder="(00) 00000-0000" value="{{ old('phone', $company->phone ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="domain" class="form-label">Domínio <span class="text-danger">*</span></label>
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
                    <label for="zip_code" class="form-label">CEP <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="00000-000" value="{{ old('zip_code', $company->zip_code ?? '') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="state" class="form-label">Estado <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control readonly-disabled" id="state" name="state" placeholder="UF" value="{{ old('state', $company->state ?? '') }}" readonly tabindex="-1">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">Cidade <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control readonly-disabled" id="city" name="city" placeholder="Cidade" value="{{ old('city', $company->city ?? '') }}" readonly tabindex="-1">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="neighborhood" class="form-label">Bairro <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Bairro" value="{{ old('neighborhood', $company->neighborhood ?? '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="street" class="form-label">Rua <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="street" name="street" placeholder="Rua" value="{{ old('street', $company->street ?? '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="number" class="form-label">Número <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="number" name="number" placeholder="Nº" value="{{ old('number', $company->number ?? '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="complement" class="form-label">Complemento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" id="complement" name="complement" placeholder="Apto, sala, etc." value="{{ old('complement', $company->complement ?? '') }}">
                    </div>
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
    .brand-column {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }
    .logo-wrapper {
        width: 270px;
        height: 270px;
    }
    .banner-preview {
        width: 100%;
        aspect-ratio: 3 / 1;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    @media (max-width: 991.98px) {
        .logo-wrapper {
            width: 150px;
            height: 150px;
        }
        .banner-preview {
            min-height: 180px;
        }
    }
    #bannerCropModal .modal-dialog {
        max-width: 90vw;
    }
    #bannerCropModal .modal-body {
        height: 70vh;
    }
    #bannerCropModal .banner-crop-area {
        width: 100%;
        height: 100%;
    }
    #bannerCropModal #bannerCropImage {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: contain;
    }
    #bannerCropModal .cropper-container,
    #bannerCropModal .cropper-wrap-box,
    #bannerCropModal .cropper-canvas {
        width: 100% !important;
        height: 100% !important;
    }
    .readonly-disabled[readonly] {
        background-color: #e9ecef !important;
        color: #6c757d !important;
        cursor: not-allowed !important;
        pointer-events: none;
        opacity: 1;
    }
</style>

<div class="modal fade" id="bannerCropModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajustar banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="banner-crop-area">
                    <img id="bannerCropImage" src="" alt="Recorte do banner">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmBannerCrop">Aplicar</button>
            </div>
        </div>
    </div>
</div>
@section('scripts-after')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/js/mask/mask.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/company/company.js') }}"></script>
@endsection
