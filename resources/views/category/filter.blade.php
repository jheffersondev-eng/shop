@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\SelectHelper;
    use App\Enums\EIsActive;
@endphp
<form method="GET" action="{{ route('category.index') }}">
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <label for="filterId" class="form-label">ID</label>
            <input type="text" 
                class="form-control" 
                id="filterId" 
                name="id" 
                value="{{ Request::get('id') }}" 
                placeholder="ID da categoria" />
        </div>
        <div class="col-md-2">
            <label for="filterName" class="form-label">Nome</label>
            <input type="text" 
                class="form-control" 
                id="filterName" 
                name="name" 
                value="{{ Request::get('name') }}" 
                placeholder="Nome da categoria" />
        </div>
        <div class="col-md-2">
            <label for="filterDateDe" class="form-label">Criado a partir</label>
            <input type="date" 
                class="form-control" 
                id="filterDateDe" 
                name="date_de" 
                value="{{ Request::get('date_de') }}" />
        </div>
        <div class="col-md-2">
            <label for="filterDateAte" class="form-label">Criado até</label>
            <input type="date" 
                class="form-control" 
                id="filterDateAte" 
                name="date_ate" 
                value="{{ Request::get('date_ate') }}" />
        </div>
        <!-- col-md-1 offset-md-2 d-flex align-items-end -->
        <div class="col-md-1 offset-md-2 d-flex align-items-end">
            {!! 
                ButtonHelper::make('Limpar')
                    ->setLink(route('category.index'))
                    ->setSize('md')
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
                    ->setSize('md')
                    ->setClass('btn btn-primary w-100')
                    ->setTitle('Filtrar')
                    ->setDataMethod('GET')
                    ->setDataAction(route('category.index'))
                    ->setIcon('bi bi-funnel')
                    ->render('button')
            !!}
        </div>
    </div>
</form>
