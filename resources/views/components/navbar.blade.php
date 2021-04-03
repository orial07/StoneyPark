<!-- navigation bar start -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
                <li class="nav-item">
                    <a class="nav-link  {{ request()->is('reserve') ? 'active' : '' }}"
                        href="{{ route('reserve') }}">Reserve</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->is('rules') ? 'active' : '' }}"
                        href="{{ route('rules') }}">Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->is('gallery') ? 'active' : '' }}"
                        href="{{ route('gallery') }}">Gallery</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
