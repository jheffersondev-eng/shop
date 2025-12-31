@php
    use App\Modules\Config\Configuration;
@endphp

<div class="mb-3 pb-3 border-bottom text-start">
    <p class="mb-2">
        <small class="text-muted">Descrição:</small><br>
        <small>{{ $description ?? '-' }}</small>
    </p>
</div>

<div class="mb-3">
    <h6 class="text-muted mb-2">Total de permissões: <strong>{{ count($permissions) }}</strong></h6>
</div>

<div class="permission-list-container" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
    <ol class="list-group list-group-numbered">
        @forelse ($permissions as $permission)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>{{ $permission }}</div>
                </div>
                <span class="badge bg-success rounded-pill">✓</span>
            </li>
        @empty
            <li class="list-group-item text-center text-muted">
                Nenhuma permissão atribuída
            </li>
        @endforelse
    </ol>
</div>
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile/permission-modal.css') }}">
@endsection