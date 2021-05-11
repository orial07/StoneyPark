@props(['icon'])

<div {{ $attributes->merge(['class' => 'd-inline mx-1 align-middle']) }}>
    <object class="d-inline mx-1 align-middle" data="{{ asset('img/amenities/' . $icon . '.svg') }}" type="image/svg+xml"></object>
    {{ $slot }}
</div>
