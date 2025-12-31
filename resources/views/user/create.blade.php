@php
    use App\Helpers\ButtonHelper;
@endphp
@extends('components.app.app')
@section('title', 'Usuários')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Novo usuário</h5>
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Voltar</a>
                </div>
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                @section('actions')
                    <div class="mt-4 d-flex gap-2">
                        {!! 
                            ButtonHelper::make('Cadastrar')
                                ->setLink(route('user.store'))
                                ->setType('submit')
                                ->setSize('lg')
                                ->setClass('btn btn-primary')
                                ->render('button') 
                        !!}
                    </div>
                @endsection
                @include('user.form')
            </form>
        </div>
    </div>
</div>
@endsection
