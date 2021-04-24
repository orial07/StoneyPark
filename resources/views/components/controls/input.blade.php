@props(['id', 'type'])

<!-- {!! $id !!} -->
<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $slot }}</label>
    <input class="form-control" id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
        autocomplete="{{ $attributes->has('autocomplete') ? 'on' : 'off' }}"
        required="{{ $attributes->has('required') ? 'true' : 'false' }}"
        {{ $attributes->merge(['placeholder' => '', 'value' => old($id)]) }} />
</div>
