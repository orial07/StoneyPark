@props(['type'])

@switch($type)
    @case('tent')
        <object class="mx-2 align-middle" data="{{ asset('img/amenities/tent.svg') }}" type="image/svg+xml"></object>
    @break
    @case('table')
        <object class="mx-2 align-middle" data="{{ asset('img/amenities/table.svg') }}" type="image/svg+xml"></object>

    @break
    @case('fire')
        <object class="mx-2 align-middle" data="{{ asset('img/amenities/fire.svg') }}" type="image/svg+xml"></object>
    @break
    @default

@endswitch
{{ $slot }}
