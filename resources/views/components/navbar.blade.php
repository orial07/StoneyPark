<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @if (Auth::user())
                <li class="nav-item">
                    <a class="nav-link  {{ str_starts_with(Route::current()->getName() ?? '', 'dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link  {{ str_starts_with(Route::current()->getName() ?? '', 'reserve') ? 'active' : '' }}" href="{{ route('reserve') }}">Reserve</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ str_starts_with(Route::current()->getName() ?? '', 'rules') ? 'active' : '' }}" href="{{ route('rules') }}">Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ str_starts_with(Route::current()->getName() ?? '', 'gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                </li>
            </ul>
        </div>
    </div>
</nav>