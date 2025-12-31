@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\ButtonInformationHelper;
@endphp
@extends('components.app.app')
@section('title', 'Unidades')
@section('content')
<div class="container-fluid px-4">
    @include('components.message')
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Unidades</h5>
                {!! 
                    ButtonHelper::make('Nova Unidade')
                        ->setLink(route('unit.create'))
                        ->setSize('md')
                        ->setClass('btn btn-success')
                        ->setIcon('bi bi-plus-lg')
                        ->render('link')
                !!}
            </div>
            <!-- Filtros -->
            @include('unit.filter')
            <!-- End Filtros -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Abreviação</th>
                        <th>Criado em</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->abbreviation }}</td>
                            <td>{{ $unit->createdAt->format('d/m/Y') }}</td>
                            <td class="text-end">    
                                {!! 
                                    ButtonInformationHelper::make()
                                        ->setCreatedBy(ucwords(strtolower($unit->userCreatedName)))
                                        ->setCreatedAt($unit->createdAt)
                                        ->setUpdatedBy(ucwords(strtolower($unit->userUpdatedName)))
                                        ->setUpdatedAt($unit->updatedAt)
                                        ->render() 
                                !!}   
                                {!!
                                    ButtonHelper::make('')
                                        ->setLink(route('unit.edit', $unit->id))
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
                                        ->setDataAction(route('unit.destroy', $unit->id))
                                        ->setDataTitle('Excluir unidade')
                                        ->setDataMessage('Deseja realmente excluir esta unidade?')
                                        ->setIcon('bi bi-trash')
                                        ->render('button')
                                !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $units->links() }}
        </div>
    </div>
</div>
@endsection
