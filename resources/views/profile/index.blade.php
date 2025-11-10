@extends('components.app.app')
@section('title', 'Perfis')
@section('content')
<div class="container-fluid px-4">
    @include('components.message')

    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Lista de Perfis</h5>
                <a href="{{ route('profile.create') }}" class="btn btn-sm btn-primary">Novo perfil</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-muted small">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Criado em</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($profiles ?? $models ?? [] as $profile)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $profile->name }}</td>
                            <td class="text-muted small">{{ optional($profile->created_at)->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="{{ route('profile.destroy', $profile->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Confirma a exclusão?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Nenhum perfil encontrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
