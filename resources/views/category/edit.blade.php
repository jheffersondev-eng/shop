@extends('components.app.app')
@section('title', 'Categorias')
@section('content')
<div class="container-fluid px-4">
    @include('components.message')

    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Editar categoria</h5>
                <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
            </div>

            <form method="POST" action="{{ route('category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-tag"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome da categoria" value="{{ old('name', $category->name) }}" required>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
