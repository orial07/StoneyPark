<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Stoney Park Campground">
    <title>Stoney Park</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body>
    <header>
        <x-navbar></x-navbar>
    </header>

    <main>
        {{ $slot }}

        <!-- FOOTER -->
        <footer class="container">
            <hr class="featurette-divider">

            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2021 Company, Inc.</p>
        </footer>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>

</html>