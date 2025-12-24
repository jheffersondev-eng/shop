@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\SelectHelper;
    use App\Enums\EIsActive;
@endphp
<form method="GET" action="{{ route('product.index') }}">
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <label for="filterId" class="form-label">ID</label>
            <input type="text" 
                class="form-control" 
                id="filterId" 
                name="id" 
                value="{{ Request::get('id') }}" 
                placeholder="ID do produto" />
        </div>
        <div class="col-md-2">
            <label for="filterName" class="form-label">Nome</label>
            <input type="text" 
                class="form-control" 
                id="filterName" 
                name="name" 
                value="{{ Request::get('name') }}" 
                placeholder="Nome do produto" />
        </div>
        <div class="col-md-2">
            <label for="filterCategory" class="form-label">Categoria</label>
            {!! 
                SelectHelper::make('category_id')
                    ->setOptions($categories)
                    ->setSelected(Request::get('category_id'))
                    ->setClass('form-control')
                    ->render();
            !!}            
        </div>
        <div class="col-md-2">
            <label for="filterCategory" class="form-label">Unidade</label>
            {!! 
                SelectHelper::make('unit_id')
                    ->setOptions($units)
                    ->setSelected(Request::get('unit_id'))
                    ->setClass('form-control')
                    ->render();
            !!}
        </div>
        <div class="col-md-2">
            <label for="filterName" class="form-label">Ativo</label>
            {!! 
                SelectHelper::make('is_active')
                    ->setOptions($isActive)
                    ->setSelected(Request::get('is_active') === null ? '' : Request::get('is_active'))
                    ->setClass('form-control')
                    ->render();
            !!}
        </div>
        <!-- col-md-1 offset-md-2 d-flex align-items-end -->
        <div class="col-md-1 d-flex align-items-end">
            {!! 
                ButtonHelper::make('Limpar')
                    ->setLink(route('product.index'))
                    ->setSize(23)
                    ->setClass('btn btn-secondary w-100')
                    ->setTitle('Limpar Filtros')
                    ->setIcon('bi bi-eraser')
                    ->render('link')
            !!}
        </div>
        <div class="col-md-1 d-flex align-items-end">
            {!!
                ButtonHelper::make('Filtrar')
                    ->setType('submit')
                    ->setSize(23)
                    ->setClass('btn btn-primary w-100')
                    ->setTitle('Filtrar')
                    ->setDataMethod('GET')
                    ->setDataAction(route('product.index'))
                    ->setIcon('bi bi-funnel')
                    ->render('button')
            !!}
        </div>
    </div>
</form>
