@php
    use App\Helpers\SelectHelper;
@endphp
<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-4">
            <label class="form-label d-block mb-3">Imagens do Produto</label>
            <!-- Container de preview das imagens -->
            <div id="imagesContainer" class="d-flex flex-wrap gap-3 mb-3">
                <!-- Primeiro item: adicionar nova imagem -->
                <div class="position-relative" style="width: 150px; height: 150px; border: 3px solid #dee2e6; border-radius: 4px; cursor: pointer;" id="addImageBox">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                        <div class="text-center">
                            <i class="bi bi-plus-lg" style="font-size: 2rem; color: #6c757d;"></i>
                            <p class="mt-2 mb-0" style="font-size: 0.85rem; color: #6c757d;">Adicionar</p>
                        </div>
                    </div>
                </div>
                <!-- Imagens existentes (se houver) -->
                @isset($product)
                    @if($product->images()->count())
                        @foreach($product->images as $productImage)
                            <div class="position-relative" style="width: 150px; height: 150px; border: 3px solid #dee2e6; border-radius: 4px;">
                                <img src="{{ asset('storage/' . $productImage->image) }}" 
                                    class="w-100 h-100"
                                    style="object-fit: cover; display: block; border-radius: 2px;">
                                <button type="button" 
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                    onclick="removeExistingImage(this, {{ $productImage->id }})"
                                    style="border-radius: 50%; width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 3px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    @endif
                @endisset
            </div>
            <!-- Input para múltiplas imagens (oculto) -->
            <input type="file" 
                id="product_image_input" 
                name="images[]" 
                class="d-none" 
                accept="image/*"
                multiple>
            <!-- Campo oculto para rastrear imagens removidas -->
            <input type="hidden" id="removedImages" name="removed_images" value="">
        </div>
    </div>
    <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
            <input type="text"
                class="form-control"
                id="name" name="name"
                placeholder="Nome do produto"
                value="{{ $product?->name ?? old('name') }}" required>
        </div>
    </div>
    <div class="col-md-3">
        <label for="category_id" class="form-label">Categoria</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-tags"></i></span>
            {!! 
                SelectHelper::make('category_id')
                    ->setOptions($categories)
                    ->setSelected($product?->category_id ?? old('category_id'))
                    ->setClass('form-control')
                    ->render();
            !!}
        </div>
    </div>
    <div class="col-md-3">
        <label for="unit_id" class="form-label">Unidade</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-rulers"></i></span>
            <select name="unit_id" id="unit_id" class="form-select form-control">
                <option value="">Selecione a unidade</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" data-rule="{{ $unit->format }}"
                        {{ ( $product?->unit_id ?? old('unit_id')) == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="barcode" class="form-label">Código de barras</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-upc"></i></span>
            <input type="text" 
                class="form-control" 
                id="barcode" 
                name="barcode" 
                placeholder="Código de barras"
                value="{{ $product?->barcode ?? old('barcode') }}">
        </div>
    </div>
    <div class="col-md-4">
        <label for="price" class="form-label">Preço (venda)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
            <input type="number" 
                step="0.01" 
                class="form-control" 
                id="price" 
                name="price" 
                placeholder="0.00"
                value="{{ $product?->price ?? old('price') }}">
        </div>
    </div>
    <div class="col-md-4">
        <label for="cost_price" class="form-label">Preço (custo)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
            <input type="number" 
                step="0.01" 
                class="form-control" 
                id="cost_price" 
                name="cost_price" 
                placeholder="0.00"
                value="{{ $product?->cost_price ?? old('cost_price') }}">
        </div>
    </div>
    <div class="col-md-4">
        <label for="stock_quantity" class="form-label">Quantidade em estoque</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-sliders"></i></span>
            <input type="number" 
                class="form-control" 
                id="stock_quantity" 
                name="stock_quantity" 
                placeholder="0"
                value="{{  $product?->stock_quantity ?? old('stock_quantity') }}">
        </div>
    </div>
    <div class="col-md-4">
        <label for="min_quantity" class="form-label">Quantidade mínima</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-sliders"></i></span>
            <input type="number" 
                class="form-control" 
                id="min_quantity" 
                name="min_quantity" 
                placeholder="0"
                value="{{ $product?->min_quantity ?? old('min_quantity') }}">
        </div>
    </div>
    <div class="col-md-4">
        <label for="is_active" class="form-label">Ativo</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
            {!! 
                SelectHelper::make('is_active')
                    ->setOptions($isActive)
                    ->setSelected($product?->is_active?->value ?? old('is_active') ?? '1')
                    ->setClass('form-control')
                    ->render();
            !!}
        </div>
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Descrição</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-fonts"></i></span>
            <textarea class="form-control" 
                id="description" 
                name="description" 
                rows="3">{{ $product?->description ?? old('description') }}</textarea>
        </div>
    </div>
</div>
<br>
@yield('actions')
@section('scripts-after')
    <script src="{{ asset('assets/js/product/quantityFormat.js') }}"></script>
    <script src="{{ asset('assets/js/product/productImageInput.js') }}"></script>
@endsection
