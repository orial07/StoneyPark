<!doctype html>
<html lang="en">

<head>
    @production
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NQM8KNZ');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0N8RXKLZ5C"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0N8RXKLZ5C');
    </script>
    <!-- End Google Tag Manager -->
    @endproduction

    {!! SEO::generate(true) !!}

    <link rel="shortcut icon" type="image/jpg" href="{{ asset('img/favicon.png') }}" />
    <!-- app styling -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <!-- Font Awesome icons -->
    <script src="https://kit.fontawesome.com/fa6beb4299.js" crossorigin="anonymous"></script>
    <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "Stoney Park Campgrounds",
            "image": "https://lh5.googleusercontent.com/p/AF1QipOmZz2O8wJ_zqc19AcB8_WTLEqCBhFc4i-bopHs=w408-h326-k-no",
            "@id": "",
            "url": "https://stoneycampgrounds.com/",
            "telephone": "+1 xxx-xxx-xxxx",
            "priceRange": "$$",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Stoney 142, 143, 144, AB",
                "addressLocality": "Ozada",
                "addressRegion": "AB",
                "postalCode": "4XWX+2P",
                "addressCountry": "CA"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 51.124472,
                "longitude": -114.9848559
            } ,
            "sameAs": "https://www.instagram.com/stoneyparkcampgrounds/" 
            }
</script>
    @yield('head')
</head>

<body>
    @production
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQM8KNZ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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