@extends('components.app.app')
@section('title', 'Unidades')
@section('content')
<div class="container-fluid px-4">
    @include('components.message')

    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Unidades</h5>
                <a href="{{ route('unit.create') }}" class="btn btn-sm btn-primary">Nova Unidade</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Abreviação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->abbreviation }}</td>
                            <td>
                                <a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form action="{{ route('unit.destroy', $unit->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                                </form>
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
