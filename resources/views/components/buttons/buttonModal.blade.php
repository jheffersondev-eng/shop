@php
    // Renderiza um botão que dispara um modal. Espera receber 'id' do modal.
    $size = $size ?? 'md';
    $rawClass = trim((string)($class ?? ''));
    $sizeClass = $size === 'sm' ? ' btn-sm' : ($size === 'lg' ? ' btn-lg' : '');
    $classes = trim(($rawClass ? $rawClass : 'btn') . $sizeClass);

    $attributes = $attributes ?? [];
    $attrString = '';
    foreach ($attributes as $k => $v) {
        $attrString .= ' ' . $k . '="' . e($v) . '"';
    }

    $idAttr = isset($id) ? ' id="' . e($id) . '"' : '';
    $target = isset($id) ? ' data-bs-toggle="modal" data-bs-target="#' . e($id) . '"' : '';
    $confirmAttr = isset($confirm) ? ' data-confirm="' . e($confirm) . '"' : '';
    $methodAttr = isset($method) ? ' data-method="' . e($method) . '"' : '';
    $isDisabled = isset($disabled) ? (bool)$disabled : false;
@endphp

@php $btnType = isset($type) ? e($type) : 'button'; @endphp
@if($isDisabled)
    <button type="{{ $btnType }}" 
            class="{{ $classes }}" 
            aria-disabled="true" 
            disabled{!! $idAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $attrString !!}>
        @if(!empty($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
@else
    <button type="{{ $btnType }}" 
            class="{{ $classes }}"
            {!! $target !!}{!! $idAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $attrString !!}>
        @if(!empty($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
@endif
