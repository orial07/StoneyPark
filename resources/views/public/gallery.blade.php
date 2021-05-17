<x-app>
    @section('title', 'Campsite Gallery')
    @section('description', 'View photos of campsites at Stoney Park Campgrounds.')

    <div class="row g-0">
        <div class="col-12 col-md-2">
            <nav id="campsites" class="navbar navbar-light bg-light flex-column align-items-stretch p-3 sticky-top" style="z-index: 0;">
                <a class="navbar-brand" href="#">Campsites</a>
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#A1-A10">Site A1 - A10</a>
                    <a class="nav-link" href="#A11">Site A11</a>
                    <a class="nav-link" href="#A12-A30">Site A12 - A30</a>
                    <a class="nav-link" href="#A31-A35">Site A31 - A35</a>
                    <a class="nav-link" href="#A36-A43">Site A36 - A43</a>
                    <a class="nav-link" href="#A44-A63">Site A44 - A63 <span class="ms-3 badge rounded-pill bg-danger">Caution</span></a>
                    <a class="nav-link" href="#B1-B13">Site B1 - B13</a>
                    <a class="nav-link" href="#B14-B15">Site B14 - B15</a>
                    <a class="nav-link" href="#B16">Site B16</a>
                    <a class="nav-link" href="#B17-B23">Site B17 - B23</a>
                    <a class="nav-link" href="#B24-B25">Site B24 - B25</a>
                    <a class="nav-link" href="#B26-B27">Site B26 - B27</a>
                    <a class="nav-link" href="#B28">Site B28</a>
                    <a class="nav-link" href="#B29">Site B29</a>
                    <a class="nav-link" href="#B30-B31">Site B30 - B31</a>
                    <a class="nav-link" href="#B32">Site B32</a>
                    <a class="nav-link" href="#B33-B37">Site B33 - B37</a>
                </nav>
            </nav>
        </div>

        <div class="col" data-bs-spy="scroll" data-bs-target="#campsites" data-bs-offset="0" tabindex="0">
            <div class="row justify-content-center">
                <div class="col-6">
                    <x-socials class="my-5">
                        <p class="text-center">See more campsite photos, general announcements and behind the scenes on our media pages!</p>
                    </x-socials>
                    <p class="lead alert text-center">Click any photo to see it in higher quality.<br>
                        <i class="fas fa-exclamation-circle"></i> This may use lots of cellular data.</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-4 row-cols-3 g-4">
                <div class="col" id="A1-A10">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/A1-A10.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite A1 - A10
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="A11">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/A11.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite A11
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="A12-A30">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/A12-A30.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite A12 - A30
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="A31-A35">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/A31-A35.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite A31 - A35
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="A36-A43">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/A36-A43.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite A36 - A43
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="A44-A63">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/A44-A63.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite A44 - A63<br>
                                <p class="alert alert-danger">
                                    <i class="fas fa-walking" aria-hidden="true"></i> These campsites are near a cliffside.
                                </p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B1-B13">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B1-B13.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B1 - B13
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B14-B15">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B14-B15.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B14 - B15
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B16">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B16.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B16
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B17-B23">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B17-B23.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B17 - B23
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B24-B25">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B24-B25.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B24 - B25
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B26-B27">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B26-B27.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B26 - B27
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B28">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B28.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B28
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B29">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B29.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B29
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B30-B31">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B30-B31.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B30 - B31
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B32">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B32.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B32
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="B33-B37">
                    <div class="card shadow-sm">
                        <img lazysrc="{{ asset('img/campgrounds/thumbnail/B33-B37.jpg') }}" />
                        <div class="card-body">
                            <p class="card-text">
                                Campsite B33 - B37
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="img-modal" class="modal modal-fullscreen" tabindex="-1">
        <div class="shadow modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <img class="image-fluid" id="img-modal-img" />
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#campsites'
        });
    </script>
    @endsection
</x-app>