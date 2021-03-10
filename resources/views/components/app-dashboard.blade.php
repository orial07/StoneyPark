<x-app>
    <div class="container mt-4">
        <ul class="nav my-4">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Profile</a>
            </li>
            @if (Auth::user())
                @if (Auth::user()->web_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reservations') }}">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.rules') }}">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.gallery') }}">Gallery</a>
                    </li>
                @endif
            @endif
        </ul>

        {{ $slot }}
    </div>
</x-app>
