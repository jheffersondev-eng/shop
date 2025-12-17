@if ($label ?? null)
    <label for="{{ $id }}" class="form-label">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-danger" aria-label="obrigatório">*</span>
        @endif
    </label>
@endif

<select
    class="form-select {{ $class ?? '' }}"
    id="{{ $id }}"
    name="{{ $name }}"
    @if ($required ?? false) required @endif
    @if ($disabled ?? false) disabled @endif
    @foreach ($attributes ?? [] as $key => $value)
        data-{{ $key }}="{{ $value }}"
    @endforeach
>
    <option value="">{{ $placeholder ?? 'Selecione' }}</option>
    @forelse ($values ?? [] as $value)
        <option
            value="{{ $value->id }}"
            @if (old($old, $selected ?? '') == $value->id) selected @endif
        >
            {{ $value[$objectName ?? 'name'] }}
        </option>
    @empty
        <option disabled>Nenhuma opção disponível</option>
    @endforelse
</select>

@if ($helpText ?? null)
    <small class="form-text text-muted d-block mt-1">{{ $helpText }}</small>
@endif
