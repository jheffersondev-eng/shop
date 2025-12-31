<!-- Modal Base Component -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true" @foreach($attributes as $key => $value) {{ $key }}="{{ $value }}" @endforeach>
    <div class="modal-dialog modal-{{ $size }} @if($centered) modal-dialog-centered @endif @if($scrollable) modal-dialog-scrollable @endif">
        <div class="modal-content">
            @if($title)
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @endif
            <div class="modal-body">
                @if($body)
                    @include($body, $data)
                @endif
            </div>
        </div>
    </div>
</div>
