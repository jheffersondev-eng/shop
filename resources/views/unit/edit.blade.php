@php
    use App\Helpers\ButtonHelper;
@endphp
@extends('components.app.app')
@section('title', 'Unidades')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Editar unidade #{{ $unit->id }}</h5>
                    <a href="{{ route('unit.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
                </div>
				@section('actions')
					<div class="mt-4 d-flex gap-2">
						{!! 
							ButtonHelper::make('Atualizar')
								->setLink(route('unit.update', $unit->id))
								->setType('submit')
								->setSize('lg')
								->setClass('btn btn-primary')
								->render('button') 
						!!}
					</div>
				@endsection
				<form method="POST" action="{{ route('unit.update', $unit->id) }}">
					@csrf
					@method('PUT')
					@include('unit.form')
				</form>
        	</div>
    	</div>
	</div>
@endsection