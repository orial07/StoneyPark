<!-- admin nav -->
<ul class="nav nav-tabs my-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/reservations') ? 'active' : '' }}"
            href="{{ route('admin.reservations') }}">Reservations</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/rules') ? 'active' : '' }}"
            href="{{ route('admin.rules') }}">Rules</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/map') ? 'active' : '' }}"
            href="{{ route('admin.map') }}">Map</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/gallery') ? 'active' : '' }}"
            href="{{ route('admin.gallery') }}">Gallery</a>
    </li>
</ul>
