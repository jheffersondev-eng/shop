@php
    use App\Helpers\SelectHelper;
@endphp
<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
            <input type="text"
                class="form-control"
                id="name" name="name"
                placeholder="Nome do produto"
                value="{{ old('name', $product->name ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-3">
        <label for="category_id" class="form-label">Categoria</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-tags"></i></span>
            {!! 
                SelectHelper::make('category_id')
                    ->setOptions($categories)
                    ->setClass('form-control')
                    ->render();
            !!}
        </div>
    </div>
    <div class="col-md-3">
        <label for="unit_id" class="form-label">Unidade</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-rulers"></i></span>
            {!! 
                SelectHelper::make('unit_id')
                    ->setOptions($units)
                    ->setClass('form-control')
                    ->render();
            !!}
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
                value="{{ old('barcode', $product->barcode ?? '') }}">
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
                value="{{ old('price', $product->price ?? '') }}">
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
                value="{{ old('cost_price', $product->cost_price ?? '') }}">
        </div>
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Descrição</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-fonts"></i></span>
            <textarea class="form-control" 
                id="description" 
                name="description" 
                rows="3">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-3">
        <label for="stock_quantity" class="form-label">Quantidade em estoque</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-sliders"></i></span>
            <input type="number" 
                class="form-control" 
                id="stock_quantity" 
                name="stock_quantity" 
                placeholder="0"
                value="{{ old('stock_quantity', isset($product->stock_quantity) ? (isset($product->unit) && $product->unit->format == 2 ? (int) $product->stock_quantity : $product->stock_quantity) : '') }}">
        </div>
    </div>
    <div class="col-md-3">
        <label for="min_quantity" class="form-label">Quantidade mínima</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-sliders"></i></span>
            <input type="number" 
                class="form-control" 
                id="min_quantity" 
                name="min_quantity" 
                placeholder="0"
                value="{{ old('min_quantity', isset($product->min_quantity) ? (isset($product->unit) && $product->unit->format == 2 ? (int) $product->min_quantity : $product->min_quantity) : '') }}">
        </div>
    </div>
    <div class="col-md-3">
        <label for="is_active" class="form-label">Ativo</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
            <select class="form-select form-control" id="is_active" name="is_active" required>
                <option value="">Selecione</option>
                @foreach ($isActive ?? [] as $key => $value)
                    <option value="{{ $key }}" {{ $product->is_active ?? '' === $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label for="image" class="form-label">Imagem</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-image"></i></span>
            <input type="file" 
                class="form-control" 
                id="image" 
                name="image" 
                accept="image/*">
        </div>
        @if (isset($product) && $product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagem do produto"
                    style="max-height:80px;">
            </div>
        @endif
    </div>
</div>
@yield('actions')
<script>
    (function() {
        const unitSelect = document.getElementById('unit_id');
        const stockQuantityInput = document.getElementById('stock_quantity');
        const minQuantityInput = document.getElementById('min_quantity');

        function updateQuantityInputs() {
            const selectedOption = unitSelect.options[unitSelect.selectedIndex];
            const format = selectedOption ? selectedOption.getAttribute('data-rule') : '1';

            // 1 = DECIMAL, 2 = INTEGER
            if (format === '2') {
                // Formato INTEGER
                stockQuantityInput.setAttribute('step', '1');
                minQuantityInput.setAttribute('step', '1');
                stockQuantityInput.placeholder = '0';
                minQuantityInput.placeholder = '0';

                // Converter valores existentes para inteiro
                if (stockQuantityInput.value && stockQuantityInput.value.includes('.')) {
                    stockQuantityInput.value = Math.round(parseFloat(stockQuantityInput.value));
                }
                if (minQuantityInput.value && minQuantityInput.value.includes('.')) {
                    minQuantityInput.value = Math.round(parseFloat(minQuantityInput.value));
                }
            } else {
                // Formato DECIMAL
                stockQuantityInput.setAttribute('step', '0.01');
                minQuantityInput.setAttribute('step', '0.01');
                stockQuantityInput.placeholder = '0.00';
                minQuantityInput.placeholder = '0.00';
            }
        }

        // Validação em tempo real para formato inteiro
        function validateIntegerInput(input) {
            const selectedOption = unitSelect.options[unitSelect.selectedIndex];
            const format = selectedOption ? selectedOption.getAttribute('data-rule') : '1';

            if (format === '2') {
                input.value = input.value.replace(/[^\d-]/g, '');
            }
        }

        if (unitSelect) {
            // Aplicar ao mudar unidade
            unitSelect.addEventListener('change', updateQuantityInputs);

            // Aplicar formato inicial
            updateQuantityInputs();
        }

        // Validação durante digitação
        if (stockQuantityInput) {
            stockQuantityInput.addEventListener('input', function() {
                validateIntegerInput(this);
            });
        }

        if (minQuantityInput) {
            minQuantityInput.addEventListener('input', function() {
                validateIntegerInput(this);
            });
        }
    })();
</script>
