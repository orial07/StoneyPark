<x-app>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 col-md-2 col-sm-4">
                <h3 class="text-center">Campsites</h3>
                <nav id="campsites" class="navbar navbar-light bg-light flex-column align-items-stretch sticky-top" style="z-index: 0;">
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link" href="#A1-A10">A1 - A10</a>
                        <a class="nav-link" href="#A11">A11</a>
                        <a class="nav-link" href="#A12-A30">A12 - A30</a>
                        <a class="nav-link" href="#A31-A35">A31 - A35</a>
                        <a class="nav-link" href="#A36-A43">A36 - A43</a>
                        <a class="nav-link" href="#A44-A63">A44 - A63 <span class="ms-3 badge rounded-pill bg-danger">Caution</span></a>
                        <a class="nav-link" href="#B1-B13">B1 - B13</a>
                        <a class="nav-link" href="#B14-B15">B14 - B15</a>
                        <a class="nav-link" href="#B16">B16</a>
                        <a class="nav-link" href="#B17-B23">B17 - B23</a>
                        <a class="nav-link" href="#B24-B25">B24 - B25</a>
                        <a class="nav-link" href="#B26-B27">B26 - B27</a>
                        <a class="nav-link" href="#B28">B28</a>
                        <a class="nav-link" href="#B29">B29</a>
                        <a class="nav-link" href="#B30-B31">B30 - B31</a>
                        <a class="nav-link" href="#B32">B32</a>
                        <a class="nav-link" href="#B33-B37">B33 - B37</a>
                    </nav>
                </nav>
            </div>
        
            <div class="col">
                <div class="row justify-content-center text-center">
                    <h1>Campsite Photos</h1>
                    <p><i class="fas fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="This may use lots of cellular data"></i> Click any photo to see it in higher quality.</p>
                </div>
        
                <div class="row row-cols-md-4 row-cols-3 g-4">
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
    </div>

    <div id="img-modal" class="modal modal-fullscreen" tabindex="-1">
        <div class="shadow modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="img-modal-img"></div>
            </div>
        </div>
    </div>
</x-app>