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
                <h5 class="mb-0">Categorias</h5>
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Nova Categoria</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories->items() as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ ucfirst(strtolower($category->name)) }}</td>
                            <td class="text-end">    
                                {!!
                                    ButtonHelper::make('')
                                        ->setLink(route('category.edit', $category->id))
                                        ->setSize(30)
                                        ->setClass('btn btn-sm btn-outline-primary')
                                        ->setIcon('bi bi-pencil')
                                        ->render('link') 
                                !!}
                                {!!
                                    ButtonHelper::make('')
                                        ->setType('button')
                                        ->setSize(8)
                                        ->setClass('btn btn-sm btn-outline-danger btn-confirm')
                                        ->setTitle('Excluir')
                                        ->setDataMethod('DELETE')
                                        ->setDataAction(route('category.destroy', $category->id))
                                        ->setDataTitle('Excluir categoria')
                                        ->setDataMessage('Deseja realmente excluir esta categoria?')
                                        ->setIcon('bi bi-trash')
                                        ->render('button')
                                !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>

@endsection
