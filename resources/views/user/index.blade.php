@php
    use App\Helpers\ButtonHelper;
    use App\Enums\EIsActive;
@endphp
@extends('components.app.app')
@section('title', 'Usuários')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Usuários</h5>
                    <div class="d-flex gap-2 align-items-center">
                        {!! ButtonHelper::make('Novo Usuário')
                            ->setLink(route('user.create'))
                            ->setSize(30)
                            ->setClass('btn btn-sm btn-success')
                            ->setIcon('bi bi-plus-lg')
                            ->render('link')
                        !!}
                    </div>
                </div>
                <!-- Filtros -->
                @include('user.filter')
                <!-- End Filtros -->
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
                                    <th scope="row">{{ $user->id }}</th>
                                    <td class="user-name">{{ ucwords(strtolower($user->userDetails->name)) }}</td>
                                    <td class="user-email">{{ ucfirst($user->email) }}</td>
                                    <td class="user-profile">{{ ucfirst(strtolower($user->profile->name)) }}</td>
                                    <td class="user-active">
                                        @php($isActive = EIsActive::from($user->isActive))
                                        <span class="{{ $isActive->getClasseBadge() }}">
                                            {{$isActive->getDescription()}}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $user->createdAt->format('d/m/Y') }}
                                    </td>
                                    <td class="text-end">    
                                        {!!
                                            ButtonHelper::make('')
                                                ->setLink(route('user.edit', $user->id))
                                                ->setSize(30)
                                                ->setClass('btn btn-sm btn-outline-primary')
                                                ->setIcon('bi bi-pencil')
                                                ->render('link') 
                                        !!}
                                        {!!
                                            ButtonHelper::make('')
                                                ->setType('button')
                                                ->setSize(23)
                                                ->setClass('btn btn-sm btn-outline-danger btn-confirm')
                                                ->setTitle('Excluir')
                                                ->setDataMethod('DELETE')
                                                ->setDataAction(route('user.destroy', $user->id))
                                                ->setDataTitle('Excluir usuário')
                                                ->setDataMessage('Deseja realmente excluir este usuário?')
                                                ->setIcon('bi bi-trash')
                                                ->render('button')
                                        !!}
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
@endsection