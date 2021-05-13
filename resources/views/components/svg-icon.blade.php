@props(['icon'])

<div {{ $attributes->merge(['class' => 'd-inline mx-1 align-middle']) }}>
    <object class="d-inline mx-1 align-middle" data="{{ asset('img/svg/' . $icon . '.svg') }}" type="image/svg+xml" tabindex="-1"></object>
    {{ $slot }}
</div>
