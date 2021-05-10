@props(['icon'])

@switch($icon)
    @case('tent')
        <object {{ $attributes->merge(['class' => 'd-inline mx-1 align-middle']) }} data="{{ asset('img/amenities/tent.svg') }}" type="image/svg+xml"></object>
    @break
    @case('table')
        <object {{ $attributes->merge(['class' => 'd-inline mx-1 align-middle']) }} data="{{ asset('img/amenities/table.svg') }}" type="image/svg+xml"></object>
    @break
    @case('fire')
        <object {{ $attributes->merge(['class' => 'd-inline mx-1 align-middle']) }} data="{{ asset('img/amenities/fire.svg') }}" type="image/svg+xml"></object>
    @break
    @default

@endswitch
{{ $slot }}
