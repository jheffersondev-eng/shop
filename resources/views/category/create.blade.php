@php
    use App\Helpers\ButtonHelper;
@endphp
@extends('components.app.app')
@section('title', 'Categorias')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Nova categoria</h5>
                    <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
                </div>
				@section('actions')
					<div class="mt-4 d-flex gap-2">
						{!! 
							ButtonHelper::make('Atualizar')
								->setLink(route('category.store'))
								->setType('submit')
								->setSize(100)
								->setClass('btn btn-primary')
								->render('button') 
						!!}
					</div>
				@endsection
            <form method="POST" action="{{ route('category.store') }}">
					@csrf
					@method('POST')
					@include('category.form')
				</form>
        	</div>
    	</div>
	</div>
@endsection
