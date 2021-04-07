@props(['name'])

<li class="nav-item">
    <a {{ $attributes->class(['nav-link', 'active' => request()->routeIs("$name*")]) }} href="{{ route($name) }}">
        {{ $slot }}
    </a>
</li>
