@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\ButtonInformationHelper;
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
                {!! 
                    ButtonHelper::make('Nova Categoria')
                        ->setLink(route('category.create'))
                        ->setSize('md')
                        ->setClass('btn btn-success')
                        ->setIcon('bi bi-plus-lg')
                        ->render('link')
                !!}
            </div>
            <!-- Filtros -->
            @include('category.filter')
            <!-- End Filtros -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="1">ID</th>
                        <th colspan="4">Nome</th>
                        <th colspan="5">Descrição</th>
                        <th colspan="2" class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories->items() as $category)
                        <tr>
                            <td colspan="1">{{ $category->id }}</td>
                            <td colspan="4">{{ ucfirst(strtolower($category->name)) }}</td>
                            <td colspan="5">{{ ucfirst(strtolower($category->description ?? '-')) }}</td>
                            <td colspan="2" class="text-end">    
                                {!! 
                                    ButtonInformationHelper::make()
                                        ->setCreatedBy(ucwords(strtolower($category->userCreatedName)))
                                        ->setCreatedAt($category->createdAt)
                                        ->setUpdatedBy(ucwords(strtolower($category->userUpdatedName)))
                                        ->setUpdatedAt($category->updatedAt)
                                        ->render() 
                                !!}   
                                {!!
                                    ButtonHelper::make('')
                                        ->setLink(route('category.edit', $category->id))
                                        ->setSize('sm')
                                        ->setClass('btn btn-outline-primary')
                                        ->setIcon('bi bi-pencil')
                                        ->render('link') 
                                !!}
                                {!!
                                    ButtonHelper::make('')
                                        ->setType('button')
                                        ->setSize('sm')
                                        ->setClass('btn btn-outline-danger btn-confirm')
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
