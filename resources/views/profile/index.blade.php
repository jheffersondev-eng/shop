@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\ButtonInformationHelper;
    use App\Modules\Config\Configuration;
    use App\Helpers\ModalHelper;
@endphp
@extends('components.app.app')
@section('title', 'Perfis')
@section('content')
<div class="container-fluid px-4">
    @include('components.message')
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Lista de Perfis</h5>
                {!! 
                    ButtonHelper::make('Novo Perfil')
                        ->setLink(route('profile.create'))
                        ->setSize('md')
                        ->setClass('btn btn-success')
                        ->setIcon('bi bi-plus-lg')
                        ->render('link')
                !!}
            </div>
            <!-- Filtros -->
            @include('profile.filter')
            <!-- End Filtros -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-muted small">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Permissões</th>
                            <th>Criado em</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($profiles as $profile)
                        <tr>
                            <th scope="row">{{ $profile->id }}</th>
                            <td>{{ ucfirst(strtolower($profile->name)) }}</td>
                            <td>
                                @php
                                    $permissions = Configuration::getPermissionNames($profile->permissions);
                                    $permissionsText = implode(', ', $permissions);
                                    $permissionsDisplay = strlen($permissionsText) > 113 ? 
                                        substr($permissionsText, 0, 113) . '...' : 
                                        $permissionsText;
                                @endphp
                                <span title="{{ $permissionsText }}">{{ $permissionsDisplay }}</span>
                            </td>
                            <td class="text-muted small">{{ $profile->createdAt->format('d/m/Y') }}</td>
                            <td class="text-end" width="15%">
                                {!! 
                                    ButtonInformationHelper::make()
                                        ->setCreatedBy(ucwords(strtolower($profile->userCreatedName)))
                                        ->setCreatedAt($profile->createdAt)
                                        ->setUpdatedBy(ucwords(strtolower($profile->userUpdatedName)))
                                        ->setUpdatedAt($profile->updatedAt)
                                        ->render() 
                                !!}    
                                {!! 
                                    ModalHelper::make()
                                        ->setSize('md')
                                        ->setTitle('#'. $profile->id . ' Perfil ' . ucfirst(strtolower($profile->name)) . ' - Permissões')
                                        ->setIcon('bi bi-eye')
                                        ->setButtonClass('btn btn-outline-warning btn-sm')
                                        ->setBody('profile.permission-modal')
                                        ->setPermission('profilecontroller@show')
                                        ->setData([
                                            'permissions' => $permissions,
                                            'description' => $profile->description,
                                            ])
                                        ->render()
                                !!}                              
                                {!!
                                    ButtonHelper::make('')
                                        ->setLink(route('profile.edit', $profile->id))
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
                                        ->setDataAction(route('profile.destroy', $profile->id))
                                        ->setDataTitle('Excluir perfil')
                                        ->setDataMessage('Deseja realmente excluir este perfil?')
                                        ->setIcon('bi bi-trash')
                                        ->render('button')
                                !!}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Nenhum perfil encontrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $profiles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
