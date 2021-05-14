<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:image" content="{{ asset('img/favicon.png') }}" />
    <meta property="og:title" content="@yield('title', 'Welcome!') &middot; {{ config('app.name') }}">
    <meta property="og:description" content="@yield('description', 'Welcome to Stoney Park Campgrounds!')">
    <meta name="description" content="@yield('description', 'Welcome to Stoney Park Campgrounds!')" />

    <title>@yield('title', 'Welcome!') &middot; {{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/jpg" href="{{ asset('img/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <!-- Font Awesome icons -->
    <script src="https://kit.fontawesome.com/fa6beb4299.js" crossorigin="anonymous"></script>

    @production
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NNTG4B2');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZJ22NSCV7G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-ZJ22NSCV7G');
    </script>
    @endproduction

    @yield('head')
</head>

<body>
    @production
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNTG4B2" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @endproduction

    <header>
        <x-navbar></x-navbar>
    </header>
    <main>
        <!-- slot -->
        {{ $slot }}

        <x-footer></x-footer>
    </main>

    <!-- app scripts -->
    <script src=" {{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>