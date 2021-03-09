<x-app>
    <div class="container mt-4">
        <ul class="nav my-4">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.rules') }}">Rules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.gallery') }}">Gallery</a>
            </li>
        </ul>

        {{ $slot }}
    </div>
</x-app>