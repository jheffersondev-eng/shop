<!-- Modal Button Component -->
@php
    $hasRestriction = isset($permission) && !$hasPermission;
@endphp
<button 
    type="button" 
    class="{{ $buttonClass }}" 
    @if(!$hasRestriction)
        data-bs-toggle="modal" 
        data-bs-target="#{{ $id }}"
    @else
        onclick="showPermissionAlert()"
    @endif
    @if($title) title="{{ $title }}" @endif
>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    @if($buttonLabel)
        {{ $buttonLabel }}
    @endif
</button>

@if($hasRestriction)
    <div class="toast-container position-fixed top-0 end-0 p-3" id="permissionToast{{ $id }}" style="display: none;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <strong class="me-auto">Permissão Negada</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Você não tem permissão para executar esta ação.
            </div>
        </div>
    </div>
    <script>
        function showPermissionAlert() {
            const toastElement = document.getElementById('permissionToast{{ $id }}');
            if (toastElement) {
                toastElement.style.display = 'block';
                const toast = new bootstrap.Toast(toastElement.querySelector('.toast'));
                toast.show();
            }
        }
    </script>
@endif
