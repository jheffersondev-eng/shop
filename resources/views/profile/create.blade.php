@php
    use App\Helpers\ButtonHelper;
@endphp
@extends('components.app.app')
@section('title', 'Perfil')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Novo perfil</h5>
                    <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
                </div>
				@section('actions')
					<div class="mt-4 d-flex gap-2">
						{!! 
							ButtonHelper::make('Cadastrar')
								->setLink(route('profile.store'))
								->setType('submit')
								->setSize('lg')
								->setClass('btn btn-primary')
								->render('button') 
						!!}
					</div>
				@endsection
				<form method="POST" action="{{ route('profile.store') }}">
					@csrf
					@method('POST')
					@include('profile.form')
				</form>
        	</div>
    	</div>
	</div>
@endsection
@section('scripts-after')
    <script src="{{ asset('assets/js/profile/accordionProfilePermissions.js') }}"></script>
@endsection