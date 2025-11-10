@php
	// Valores padrões e normalizações
	$size = $size ?? 'md';
	$rawClass = trim((string)($class ?? ''));
	$sizeClass = $size === 'sm' ? ' btn-sm' : ($size === 'lg' ? ' btn-lg' : '');
	// Mantemos uma classe base 'btn' para consistência, mas o projeto pode sobrescrever
	$classes = trim(($rawClass ? $rawClass : 'btn') . $sizeClass);

	// Determina href: url direto tem prioridade, depois route (nome ou array [name, params])
	$href = '#';
	if (!empty($url)) {
		$href = $url;
	} elseif (!empty($route)) {
		try {
			if (is_array($route) && count($route) > 0) {
				$name = $route[0];
				$params = $route[1] ?? [];
				$href = route($name, $params);
			} else {
				$href = route($route);
			}
		} catch (\Throwable $e) {
			$href = '#';
		}
	}

	$attributes = $attributes ?? [];
	$attrString = '';
	foreach ($attributes as $k => $v) {
		$attrString .= ' ' . $k . '="' . e($v) . '"';
	}

	$idAttr = isset($id) ? ' id="' . e($id) . '"' : '';
	$targetAttr = isset($target) ? ' target="' . e($target) . '"' : '';
	$confirmAttr = isset($confirm) ? ' data-confirm="' . e($confirm) . '"' : '';
	$methodAttr = isset($method) ? ' data-method="' . e($method) . '"' : '';
	$isDisabled = isset($disabled) ? (bool)$disabled : false;
@endphp

@if($isDisabled)
	<a href="#" class="{{ $classes }} disabled" aria-disabled="true"{!! $idAttr !!}{!! $targetAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $attrString !!}>
		@if(!empty($icon))<i class="{{ $icon }}"></i>@endif
		{{ $label ?? '' }}
	</a>
@else
	<a href="{{ $href }}" class="{{ $classes }}"{!! $idAttr !!}{!! $targetAttr !!}{!! $confirmAttr !!}{!! $methodAttr !!}{!! $attrString !!}>
		@if(!empty($icon))<i class="{{ $icon }}"></i>@endif
		{{ $label ?? '' }}
	</a>
@endif
