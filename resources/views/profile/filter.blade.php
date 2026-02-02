@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\SelectHelper;
    use App\Enums\EIsActive;
@endphp
<form method="GET" action="{{ route('profile.index') }}">
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <label for="filterId" class="form-label">ID</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-123"></i></span>
                <input type="text" 
                    class="form-control" 
                    id="filterId" 
                    name="id" 
                    value="{{ Request::get('id') }}" 
                    placeholder="ID do perfil" />
            </div>
        </div>
        <div class="col-md-2">
            <label for="filterName" class="form-label">Nome</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-123"></i></span>
                <input type="text" 
                    class="form-control" 
                    id="filterName" 
                    name="name" 
                    value="{{ Request::get('name') }}" 
                    placeholder="Nome do perfil" />
            </div>
        </div>
        <div class="col-md-2">
            <label for="filterDateDe" class="form-label">Criado a partir</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="date" 
                    class="form-control" 
                    id="filterDateDe" 
                    name="date_de" 
                    value="{{ Request::get('date_de') }}" />
            </div>
        </div>
        <div class="col-md-2">
            <label for="filterDateAte" class="form-label">Criado até</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="date" 
                    class="form-control" 
                    id="filterDateAte" 
                    name="date_ate" 
                    value="{{ Request::get('date_ate') }}" />
            </div>
        </div>
        <!-- col-md-1 offset-md-2 d-flex align-items-end -->
        <div class="col-md-1 offset-md-2 d-flex align-items-end">
            {!! 
                ButtonHelper::make('Limpar')
                    ->setLink(route('profile.index'))
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
                    ->setDataAction(route('profile.index'))
                    ->setIcon('bi bi-funnel')
                    ->render('button')
            !!}
        </div>
    </div>
</form>
