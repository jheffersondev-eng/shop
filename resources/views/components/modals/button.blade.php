<!-- Modal Button Component -->
<button 
    type="button" 
    class="{{ $buttonClass }}" 
    data-bs-toggle="modal" 
    data-bs-target="#{{ $id }}"
    @if($title) title="{{ $title }}" @endif
>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    @if($buttonLabel)
        {{ $buttonLabel }}
    @endif
</button>
