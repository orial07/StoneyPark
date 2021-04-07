<nav class="navbar navbar-expand-md shadow navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @auth
                    <!-- Example split danger button -->
                    <div class="btn-group">
                        <x-nav-item name="account">Account</x-nav-item>

                        <a class="nav-link dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->web_admin)
                                <x-nav-item name="admin" class="dropdown-item">Admin Panel</x-nav-item>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <x-nav-item name="logout" class="dropdown-item">Logout</x-nav-item>
                        </ul>
                    </div>
                @endauth
                @guest
                    <x-nav-item name="login">Login</x-nav-item>
                @endguest
                <x-nav-item name="reserve">Reserve</x-nav-item>
                <x-nav-item name="rules">Rules</x-nav-item>
                <x-nav-item name="gallery">Gallery</x-nav-item>
            </ul>
        </div>
    </div>
</nav>
