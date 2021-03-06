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
                            <a class="nav-link active" href="/gallery">Gallery</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-4">
                    <img src="{{ asset('img/gallery/fire.jpg') }}" class="img-thumbnail" />
                </div>
                <div class="col-4">
                    <img src="{{ asset('img/gallery/fire.jpg') }}" class="img-thumbnail" />
                </div>
                <div class="col-4">
                    <img src="{{ asset('img/gallery/fire.jpg') }}" class="img-thumbnail" />
                </div>
            </div>

            <!-- ================================================== -->
            <hr class="featurette-divider">
        </div>

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