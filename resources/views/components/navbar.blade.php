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
                    <!-- Example split danger button -->
                    <div class="btn-group">
                        <a class="nav-link" href="{{ route('account') }}">Account</a>
                        <a class="nav-link dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->web_admin)
                                <li><a class="dropdown-item" href="{{ route('admin') }}">Admin Panel</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
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
