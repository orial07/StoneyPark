@props(['icon'])

<object {{ $attributes->merge(['class' => 'd-block']) }} data="{{ asset('img/svg/' . $icon . '.svg') }}" type="image/svg+xml" tabindex="-1"></object>