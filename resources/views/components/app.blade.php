<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="og:title" content="{{ config('app.name') }} &middot; @yield('title', 'Welcome!')">
    <meta name="og:description" content="Stoney Campgrounds">

    <title>{{ config('app.name') }} &middot; @yield('title', 'Welcome!')</title>
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

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>