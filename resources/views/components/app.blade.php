<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:image" content="{{ asset('img/favicon.png') }}" />
    <meta property="og:title" content="{{ config('app.name') }} &middot; @yield('title', 'Welcome!')">
    <meta property="og:description" content="Welcome to Stoney Park Campgrounds!">

    <title>{{ config('app.name') }} &middot; @yield('title', 'Welcome!')</title>

    <link rel="shortcut icon" type="image/jpg" href="{{ asset('img/favicon.png') }}" />

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

        <x-footer></x-footer>
    </main>

    <!-- app scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
