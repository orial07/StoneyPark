<!-- dashboard nav -->
<ul class="nav nav-tabs my-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
            href="{{ route('dashboard') }}">Profile</a>
    </li>
    @if (Auth::user()->web_admin)
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/reservations') ? 'active' : '' }}"
                href="{{ route('dashboard.reservations') }}">Reservations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/map') ? 'active' : '' }}"
                href="{{ route('dashboard.map') }}">Map</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/rules') ? 'active' : '' }}"
                href="{{ route('dashboard.rules') }}">Rules</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/gallery') ? 'active' : '' }}"
                href="{{ route('dashboard.gallery') }}">Gallery</a>
        </li>
    @endif
</ul>
