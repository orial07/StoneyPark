@props(['icon'])

<object {{ $attributes->merge(['class']) }} data="{{ asset('img/svg/' . $icon . '.svg') }}" type="image/svg+xml" tabindex="-1"></object>
{!! $slot !!}