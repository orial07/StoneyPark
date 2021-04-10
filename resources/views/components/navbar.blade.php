<nav class="navbar navbar-expand-md shadow navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="main-navbar-dropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="main-navbar-dropdown">
                            <x-nav-item class="dropdown-item" href="account">My Profile</x-nav-item>
                            <x-nav-item class="dropdown-item" href="admin">Admin Panel</x-nav-item>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <x-nav-item class="dropdown-item" href="logout">Logout</x-nav-item>
                        </ul>
                    </li>
                @endauth
                @guest
                    <x-nav-item class="nav-link" href="login">Login</x-nav-item>
                @endguest
                <x-nav-item class="nav-link" href="reserve">Reserve</x-nav-item>
                <x-nav-item class="nav-link" href="rules">Rules</x-nav-item>
                <x-nav-item class="nav-link" href="gallery">Gallery</x-nav-item>
            </ul>
        </div>
    </div>
</nav>