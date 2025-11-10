@php
    $size = $size ?? null;
    $rawClass = trim((string)($class ?? ''));
    $classes = trim(($rawClass ? $rawClass : 'btn'));

    $attributes = $attributes ?? [];
    $attrString = '';

    foreach ($attributes as $attribute => $index) {
        $attrString .= ' ' . $attribute . '="' . e($index) . '"';
    }

    $idAttr = isset($id) ? ' id="' . e($id) . '"' : '';
    $confirmAttr = isset($confirm) ? ' data-confirm="' . e($confirm) . '"' : '';
    $methodAttr = isset($method) ? ' data-method="' . e($method) . '"' : '';
    $isDisabled = isset($disabled) ? (bool)$disabled : false;
@endphp

@php $btnType = isset($type) ? e($type) : 'button'; @endphp
@if($isDisabled)
    <button type="{{ $btnType }}" 
            class="{{ $classes }}" 
            aria-disabled="true" 
            disabled{!! $idAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $attrString !!}
            style="{{ $size ? 'width: ' . e($size) . '%' : '' }}">
        @if(!empty($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
@else
    <button type="{{ $btnType }}" 
            class="{{ $classes }}"{!! $idAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $attrString !!}
            style="{{ $size ? 'width: ' . e($size) . '%' : '' }}">
        @if(!empty($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
@endif
