@props(['id', 'type'])

@env('local')
<!-- {{ $id }} -->
@endenv

<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $slot }}</label>
    <input class="form-control" id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
        value="{{ old($id) }}" 
        autocomplete="{{ $attributes->has('autocomplete') ? 'on' : 'off' }}"
        required="{{ $attributes->has('required') ? 'true' : 'false' }}" />
</div>
