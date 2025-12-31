@php
    use App\Helpers\ButtonInformationHelper;

    $data = ButtonInformationHelper::prepare(
        createdBy: $createdBy,
        createdAt: $createdAt ?? null,
        updatedBy: $updatedBy ?? null,
        updatedAt: $updatedAt ?? null,
        deletedBy: $deletedBy ?? null,
        deletedAt: $deletedAt ?? null,
    );
@endphp

<div class="position-relative d-inline-block">
    <button 
        type="button" 
        class="btn btn-sm btn-outline-secondary"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        title="{{ $data['lastActionLabel'] }}"
    >
        <i class="bi {{ $data['icon'] }}"></i>
    </button>

    {{-- Tooltip detalhado ao clicar --}}
    <div class="btn-information-tooltip" style="display: none; position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 12px; border-radius: 4px; font-size: 12px; white-space: normal; z-index: 1000; margin-bottom: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); width: 220px;">
        @foreach ($data['history'] as $action => $info)
            <div style="margin-bottom: 10px; line-height: 1.6;">
                @switch($action)
                    @case('created')
                        <strong>Criado por</strong> {{ $info['by'] }}<br>
                        <small style="color: #aaa;">{{ $info['at'] }}</small>
                        @break
                    @case('updated')
                        <strong>Atualizado por</strong> {{ $info['by'] }}<br>
                        <small style="color: #aaa;">{{ $info['at'] }}</small>
                        @break
                    @case('deleted')
                        <strong>Deletado por</strong> {{ $info['by'] }}<br>
                        <small style="color: #aaa;">{{ $info['at'] }}</small>
                        @break
                @endswitch
            </div>
        @endforeach
    </div>
</div>

@push('scripts-after')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Exibir tooltip detalhado ao clicar
            document.querySelectorAll('.btn-outline-secondary').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tooltip = this.parentElement.querySelector('.btn-information-tooltip');
                    
                    if (tooltip) {
                        tooltip.style.display = tooltip.style.display === 'none' ? 'block' : 'none';
                    }
                });
            });

            // Fechar ao clicar fora
            document.addEventListener('click', function(e) {
                document.querySelectorAll('.btn-information-tooltip').forEach(tooltip => {
                    if (!tooltip.parentElement.contains(e.target)) {
                        tooltip.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
