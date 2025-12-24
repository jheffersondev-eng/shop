<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-tag"></i></span>
            <input type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                placeholder="Nome da categoria"
                value="{{ old('name', $category->name ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <label for="description" class="form-label">Descrição</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-fonts"></i></span>
            <input type="text" 
                class="form-control" 
                id="description" 
                name="description" 
                placeholder="Descrição da categoria"
                value="{{ old('description', $category->description ?? '') }}" required>
        </div>
    </div>
</div>
@yield('actions')