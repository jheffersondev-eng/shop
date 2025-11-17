<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto"
               value="{{ old('name', isset($product) ? $product->name : '') }}" required>
    </div>

    <div class="col-md-3">
        <label for="category_id" class="form-label">Categoria</label>
        <select class="form-select" id="category_id" name="category_id">
            <option value="">Selecione</option>
            @foreach($categories ?? [] as $category)
                <option value="{{ $category->id }}" {{ (string) old('category_id', isset($product) ? $product->category_id : '') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="unit_id" class="form-label">Unidade</label>
        <select class="form-select" id="unit_id" name="unit_id">
            <option value="">Selecione</option>
            @foreach($units ?? [] as $unit)
                <option value="{{ $unit->id }}" {{ (string) old('unit_id', isset($product) ? $product->unit_id : '') === (string) $unit->id ? 'selected' : '' }}>{{ $unit->name ?? $unit->label ?? $unit->id }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="barcode" class="form-label">Código de barras</label>
        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Código de barras"
               value="{{ old('barcode', isset($product) ? $product->barcode : '') }}">
    </div>

    <div class="col-md-4">
        <label for="price" class="form-label">Preço (venda)</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="0.00"
               value="{{ old('price', isset($product) ? $product->price : '') }}">
    </div>

    <div class="col-md-4">
        <label for="cost_price" class="form-label">Preço (custo)</label>
        <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" placeholder="0.00"
               value="{{ old('cost_price', isset($product) ? $product->cost_price : '') }}">
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
    </div>

    <div class="col-md-3">
        <label for="stock_quantity" class="form-label">Quantidade em estoque</label>
        <input type="number" step="0.01" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="0"
               value="{{ old('stock_quantity', isset($product) ? $product->stock_quantity : '') }}">
    </div>

    <div class="col-md-3">
        <label for="min_quantity" class="form-label">Quantidade mínima</label>
        <input type="number" step="0.01" class="form-control" id="min_quantity" name="min_quantity" placeholder="0"
               value="{{ old('min_quantity', isset($product) ? $product->min_quantity : '') }}">
    </div>

    <div class="col-md-3">
        <label for="is_active" class="form-label">Ativo</label>
        <select class="form-select" id="is_active" name="is_active">
            @php $currentActive = old('is_active', isset($product) ? (int) $product->is_active : 1); @endphp
            <option value="1" {{ $currentActive === 1 ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ $currentActive === 0 ? 'selected' : '' }}>Não</option>
        </select>
    </div>

    <div class="col-md-3">
        <label for="image" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if(isset($product) && $product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagem do produto" style="max-height:80px;">
            </div>
        @endif
    </div>
</div>

@yield('actions')
