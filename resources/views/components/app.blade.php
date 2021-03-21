<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Stoney Park Campground">
    <title>Stoney Park</title>
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

            <p class="float-start">&copy; 2021 Stoney Campground.</p>
            <p class="float-end"><a href="#">Back to top</a></p>
        </footer>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>
