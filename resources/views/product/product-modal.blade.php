@php
    use App\Helpers\NumberHelper;
@endphp
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product/product-modal.css') }}">
@endsection
<div class="product-modal-container">
    <div class="row g-4 mb-4">
        <div class="col-md-5">
            <h3 class="mb-3 fw-bold" style="text-align: left;">{{ ucfirst(strtolower($product->name)) }}</h3>
            <div id="productImageCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                <div class="carousel-inner rounded-3 overflow-hidden shadow-sm">
                    @forelse($product->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" 
                                class="d-block w-100" 
                                alt="{{ $product->name }}"
                                style="object-fit: cover; height: 350px;">
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                style="height: 350px;">
                                <div class="text-center text-muted">
                                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                                    <p class="mt-2 mb-0">Sem imagem</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if(count($product->images) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                @endif
            </div>
            @if(count($product->images) > 1)
                <div class="d-flex gap-2 flex-wrap mb-4">
                    @foreach($product->images as $index => $image)
                        <img src="{{ asset('storage/' . $image) }}" 
                            class="img-thumbnail cursor-pointer" 
                            style="width: 70px; height: 70px; object-fit: cover; cursor: pointer; border: 2px solid transparent; transition: all 0.3s;"
                            onclick="document.querySelector('#productImageCarousel').carousel({{ $index }}); this.style.borderColor='#28a745';"
                            alt="{{ $product->name }}">
                    @endforeach
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="mb-4">
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-info">{{ ucfirst(strtolower($product->category->name)) }}</span>
                    @if($product->isActive)
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Ativo</span>
                    @else
                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Inativo</span>
                    @endif
                </div>
            </div>
            <div class="product-info-card">
                <h6 class="mb-3 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-cash-coin" style="color: #28a745;"></i> Informações de Preço
                </h6>
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="info-label mb-1">Preço de Custo</div>
                        <div class="info-value text-danger">{{ NumberHelper::currency($product->costPrice) }}</div>
                    </div>
                    <div class="col-6">
                        <div class="info-label mb-1">Preço de Venda</div>
                        <div class="info-value text-success">{{ NumberHelper::currency($product->price) }}</div>
                    </div>
                </div>
                @php
                    $margin = $product->costPrice > 0 ? (($product->price - $product->costPrice) / $product->costPrice) * 100 : 0;
                    $difference = $product->price - $product->costPrice;
                @endphp
                <div class="price-highlight">
                    <div class="info-label" style="color: rgba(255,255,255,0.9); margin-bottom: 0.5rem;">Margem de Lucro</div>
                    <div style="font-size: 1.5rem; font-weight: bold;">{{ number_format($margin, 1) }}%</div>
                    <small style="opacity: 0.9;">Ganho: {{ NumberHelper::currency($difference) }}</small>
                </div>
            </div>
            <div class="product-info-card">
                <h6 class="mb-3 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam" style="color: #0d6efd;"></i> Estoque
                </h6>
                <div class="product-info-row">
                    <span class="info-label">Quantidade Disponível</span>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="info-value">{{ NumberHelper::simple($product->stockQuantity) }}</span>
                        <span class="text-muted small">{{ $product->unit->name }} ({{ $product->unit->abbreviation }})</span>
                    </div>
                </div>
                <div class="product-info-row">
                    <span class="info-label">Quantidade Mínima</span>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="info-value">{{ NumberHelper::simple($product->minQuantity) }}</span>
                        <span class="text-muted small">{{ $product->unit->abbreviation }}</span>
                    </div>
                </div>
                <div class="product-info-row">
                    <span class="info-label">Status do Estoque</span>
                    <span class="badge {{ $product->stockQuantity > $product->minQuantity ? 'bg-success' : 'bg-warning' }}">
                        @if($product->stockQuantity > $product->minQuantity)
                            <i class="bi bi-check-circle"></i> Suficiente
                        @else
                            <i class="bi bi-exclamation-triangle"></i> Baixo
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    @if($product->description)
    <div class="row">
        <div class="col-12">
            <div class="product-info-card">
                <h6 class="mb-3 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-file-text" style="color: #0d6efd;"></i> Descrição
                </h6>
                <p class="mb-0 small" style="line-height: 1.7; color: #495057; text-align: left;">
                    {{ ucfirst(strtolower($product->description)) }}
                </p>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="product-info-card">
                <h6 class="mb-3 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-box" style="color: #6c757d;"></i> Identificação do Produto ID #{{ $product->id }}
                </h6>
                @if($product->barcode)
                    <div style="margin-bottom: 0;">
                        <div class="info-label mb-2" style="text-align: left;">Código de Barras</div>
                        <div style="background: white; padding: 0.75rem; border-radius: 4px; border: 1px dashed #dee2e6; text-align: center;">
                            <code style="word-break: break-all; font-size: 0.8rem;">{{ $product->barcode }}</code>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="product-info-card">
                <h6 class="mb-3 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-clock-history" style="color: #6f42c1;"></i> Histórico
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-label mb-2">Criado Por</div>
                        <p class="mb-1 small fw-500">{{ ucwords(strtolower($product->userCreatedName)) }}</p>
                        <small class="text-muted">{{ $product->createdAt->format('d/m/Y') }} às {{ $product->createdAt->format('H:i') }}</small>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label mb-2">Última Atualização</div>
                        <p class="mb-1 small fw-500">{{ ucwords(strtolower($product->userUpdatedName)) }}</p>
                        <small class="text-muted">{{ $product->updatedAt->format('d/m/Y') }} às {{ $product->updatedAt->format('H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>