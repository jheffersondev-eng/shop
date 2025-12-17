<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-rulers"></i></span>
            <input 
                type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                placeholder="Nome da unidade" 
                value="{{ old('name', isset($unit) ? $unit->name : '') }}" required>
        </div>
    </div>
    <div class="col-md-3">
        <label for="abbreviation" class="form-label">Abreviação</label>
        <input 
            type="text" 
            class="form-control" 
            id="abbreviation" 
            name="abbreviation" 
            placeholder="ex: kg" 
            value="{{ old('abbreviation', isset($unit) ? $unit->abbreviation : '') }}">
    </div>
    <div class="col-md-3">
        <label for="format" class="form-label">Formato</label>
        <select class="form-select form-control" id="format" name="format" required>
            @foreach($unitFormats as $value => $unitFormat)
                <option value="{{ $value }}" {{ (string) old('format') === (string) $value ? 'selected' : '' }}>{{ $unitFormat }}</option>
            @endforeach
        </select>
    </div>
</div>