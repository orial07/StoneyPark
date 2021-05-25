<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="main-navbar-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="main-navbar-dropdown">
                        <x-nav-item class="dropdown-item" href="account">My Account</x-nav-item>
                        @if (auth()->user()->web_admin)
                        <x-nav-item class="dropdown-item" href="admin">Admin Panel</x-nav-item>
                        @endif
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <x-nav-item class="dropdown-item" href="logout">Logout</x-nav-item>
                    </ul>
                </li>
                @endauth
                <x-nav-item class="nav-link" href="reserve">Reserve</x-nav-item>
                <x-nav-item class="nav-link" href="rules">Rules</x-nav-item>
                <x-nav-item class="nav-link" href="gallery">Gallery</x-nav-item>
            </ul>
        </div>
        <ul class="navbar-nav justify-content-end">
            <x-nav-item class="nav-link" href="contact">Contact Us</x-nav-item>
        </ul>
    </div>
</nav>