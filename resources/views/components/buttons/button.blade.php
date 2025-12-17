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
    $titleAttr = isset($title) ? ' title="' . e($title) . '"' : '';
    $dataMethodAttr = isset($dataMethod) ? ' data-method="' . e($dataMethod) . '"' : '';
    $dataActionAttr = isset($dataAction) ? ' data-action="' . e($dataAction) . '"' : '';
    $dataTitleAttr = isset($dataTitle) ? ' data-title="' . e($dataTitle) . '"' : '';
    $dataMessageAttr = isset($dataMessage) ? ' data-message="' . e($dataMessage) . '"' : '';
    $isDisabled = isset($disabled) ? (bool)$disabled : false;
@endphp

@php $btnType = isset($type) ? e($type) : 'button'; @endphp
@if($isDisabled)
    <button type="{{ $btnType }}" 
            class="{{ $classes }}" 
            aria-disabled="true" 
            disabled{!! $idAttr !!}{!! $titleAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $dataMethodAttr !!}{!! $dataActionAttr !!}{!! $dataTitleAttr !!}{!! $dataMessageAttr !!}{!! $attrString !!}
            style="{{ $size ? 'width: ' . e($size) . '%' : '' }}">
        @if(!empty($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
@else
    <button type="{{ $btnType }}" 
            class="{{ $classes }}"{!! $idAttr !!}{!! $titleAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $dataMethodAttr !!}{!! $dataActionAttr !!}{!! $dataTitleAttr !!}{!! $dataMessageAttr !!}{!! $attrString !!}
            style="{{ $size ? 'width: ' . e($size) . '%' : '' }}">
        @if(!empty($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
@endif
