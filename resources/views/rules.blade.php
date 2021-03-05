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
                            <a class="nav-link active" aria-current="page" href="/rules">Rules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reserve">Reserve</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <p class="lead">
                We love our park, so we want the best for it.<br />
                Please read the following Yes and No rules and abide by them when on campgrounds.
            </p>

            <div class="list-group">
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Yes</h5>
                    </div>
                    <p class="mb-1">Do that. Yes, that.</p>
                    <small>Not the other thing.</small>
                </div>

                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">No</h5>
                    </div>
                    <p class="mb-1">That's bad.</p>
                    <small class="text-muted">Maybe take a picture of it... from afar</small>
                </div>

                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Maybe</h5>
                    </div>
                    <p class="mb-1">Be a STAR.</p>
                    <small class="text-muted">That means Stop Think Act Review.</small>
                </div>
            </div> <!-- list-group end -->

        </div>

        <!-- ================================================== -->
        <hr class="featurette-divider">

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