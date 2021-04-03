<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Stoney Campgrounds">
    <title>{{ config('app.name') }} @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @yield('head')
</head>

<body>
    <header>
        <x-navbar></x-navbar>
    </header>

    <main>
        <!-- slot -->
        {{ $slot }}

        <!-- footer -->
        <footer class="container-md container-sm-fluid">
            <hr class="featurette-divider">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        <small>&copy; 2021 {{ env('APP_NAME') }}</small>
                    </div>
                    <div class="col">
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="{{ route('contact') }}">Contact Us</a></li>
                            @guest
                                <li><a class="text-muted" href="{{ route('login') }}">Login</a></li>
                            @endguest
                            @auth
                                <li><a class="text-muted" href="{{ route('account') }}">My Account</a></li>
                                <li><a class="text-muted" href="{{ route('logout') }}">Logout</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="{{ route('reserve') }}">Reserve</a></li>
                            <li><a class="text-muted" href="{{ route('rules') }}">Rules</a></li>
                            <li><a class="text-muted" href="{{ route('gallery') }}">Gallery</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>
