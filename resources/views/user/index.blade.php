@extends('components.app.app')
@section('title', 'Usuários')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Lista de Usuários</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <input id="table-search" type="search" class="form-control form-control-sm" placeholder="Pesquisar..."
                            style="min-width:200px;">
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Novo</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">Ativo</th>
                                <th scope="col">Criado em</th>
                                <th scope="col" class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                            @forelse($users ?? [] as $user)
                                <tr class="user-row">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="user-name">{{ $user->userDetail->name_and_surname ?? ($user->name ?? '-') }}</td>
                                    <td class="user-email">{{ $user->email ?? '-' }}</td>
                                    <td class="user-profile">{{ $user->profile->name ?? '-' }}</td>
                                    <td class="user-active">
                                        @if (optional($user)->is_active)
                                            <span class="badge bg-success">Sim</span>
                                        @else
                                            <span class="badge bg-secondary">Não</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ optional($user->created_at)->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="text-end">
                                        <a href="" class="btn btn-sm btn-light border" title="Ver"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-outline-primary"
                                            title="Editar"><i class="bi bi-pencil"></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-confirm"
                                            title="Excluir" data-action="{{ route('user.destroy', $user->id) }}"
                                            data-method="DELETE" data-title="Excluir usuário"
                                            data-message="Deseja realmente excluir este usuário?">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        @parent
        <script>
            // Busca client-side simples: filtra linhas por nome, email ou perfil
            (function() {
                const input = document.getElementById('table-search');
                if (!input) return;
                const tbody = document.getElementById('users-table-body');
                input.addEventListener('input', function() {
                    const q = this.value.trim().toLowerCase();
                    const rows = tbody.querySelectorAll('.user-row');
                    rows.forEach(r => {
                        const name = r.querySelector('.user-name')?.textContent.toLowerCase() || '';
                        const email = r.querySelector('.user-email')?.textContent.toLowerCase() || '';
                        const profile = r.querySelector('.user-profile')?.textContent.toLowerCase() || '';
                        const match = q === '' || name.includes(q) || email.includes(q) || profile.includes(
                            q);
                        r.style.display = match ? '' : 'none';
                    });
                });
            })();
        </script>
    @endsection
@endsection