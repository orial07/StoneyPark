<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:image" content="{{ asset('img/favicon.png') }}" />
    <meta property="og:title" content="@yield('title', 'Welcome!') &middot; {{ config('app.name') }}">
    <meta property="og:description" content="Welcome to Stoney Park Campgrounds!">

    <title>@yield('title', 'Welcome!') &middot; {{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/jpg" href="{{ asset('img/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script src="https://kit.fontawesome.com/fa6beb4299.js" crossorigin="anonymous"></script>
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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZJ22NSCV7G"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-ZJ22NSCV7G');
    </script>
    <!-- app scripts -->
    <script src=" {{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>