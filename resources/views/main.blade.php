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
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/rules">Rules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reserve">Reserve</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/gallery">Gallery</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for ($i = 0; $i < sizeof($carousel); $i++)
                    @if ($i == 0)
                        <button class="active" aria-current="true" type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" aria-label="Slide {{ $i }}"></button>
                    @else
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" aria-label="Slide {{ $i }}"></button>
                    @endif
                @endfor
            </div>
            <div class="carousel-inner">
                @for ($i = 0; $i < sizeof($carousel); $i++)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" style="background-image: url({{ asset($carousel[$i]->image) }})">
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>{{ $carousel[$i]->title }}</h1>
                            <p>{{ $carousel[$i]->subtitle }}</p>
                            <p><a class="btn btn-lg btn-primary" href="/reserve">{{ $carousel[$i]->button }}</a></p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>

        <!-- ================================================== -->

        <div class="container marketing">
            <h2 class="text-center featurette-heading mb-4">Find us on social media</h2>
            <div class="row justify-content-center text-center">
                <div class="col-2 col-md-1 mx-4">
                    <a class="d-block" href="https://facebook.com" target="_blank">
                        <object class="mx-auto" data="{{ asset('img/facebook.svg') }}" type="image/svg+xml"></object>
                    </a>
                </div>
                <div class="col-2 col-md-1 mx-4">
                    <a class="d-block" href="https://instagram.com" target="_blank">
                        <object class="mx-auto" data="{{ asset('img/instagram.svg') }}" type="image/svg+xml"></object>
                    </a>
                </div>
                <div class="col-2 col-md-1 mx-4">
                    <a class="d-block" href="https://tiktok.com" target="_blank">
                        <object class="mx-auto" data="{{ asset('img/tiktok.svg') }}" type="image/svg+xml"></object>
                    </a>
                </div>
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">The view? <span class="text-muted">We got that.</span></h2>
                    <p class="lead">See beautiful mountains, tall trees and acres of greenery.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                </div>
                <div class="col-md-5">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="{{ asset('img/market1.jpg') }}" />
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">Not convinced? <span class="text-muted">See for yourself.</span></h2>
                    <p class="lead">Reservations are just a click away. Simple and fast.</p>
                    <p><a class="btn btn-lg btn-primary" href="/reserve">Reserve</a></p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="{{ asset('img/market2.jpg') }}" />
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->

        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2021 Company, Inc.</p>
        </footer>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>