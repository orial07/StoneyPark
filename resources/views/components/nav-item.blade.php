@props(['href'])

<li class="nav-item">
    <a href="/{{ $href }}"
        {{ $attributes->class(['active' => request()->is($href.'*')])->merge() }}>
        {{ $slot }}
    </a>
</li>
