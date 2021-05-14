<x-app>
    @section('title', 'Campsite Gallery')
    @section('description', 'View photos of campsites at Stoney Park Campgrounds')

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
            <x-socials class="my-5">
                <p class="lead text-center">Click any photo to see it in high quality.<br>
                    <i class="fas fa-exclamation-circle"></i> This may use lots of cellular data.</p>
                <p class="text-center">See more photos, announcements and behind the scenes on these pages!</p>
            </x-socials>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/A1-A10.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="A1-A10">A1 - A10</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="A11">A11</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/A11.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/A12-A30.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="A12-A30">A12 - A30</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="A31-A35">A31 - A35</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/A31-A35.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/A36-A43.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="A36-A43">A36 - A43</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col p-4 d-flex flex-column align-items-center justify-content-center">
                    <h4 id="A44-A63">A44 - A63</h4>
                    <p class="fs-4"><i class="fas fa-walking"></i> Be careful! These sites are near a cliffside.</p>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/A44-A63.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B1-B13.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B1-B13">B1 - B13</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B14-B15">B14 - B15</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B14-B15.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B16.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B16">B16</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B17-B23">B17 - B23</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B17-B23.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B24-B25.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B24-B25">B24 - B25</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B26-B27">B26 - B27</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B26-B27.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B28.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B28">B28</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B29">B29</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B29.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B30-B31.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B30-B31">B30 - B31</h4>
                </div>
            </div>

            <div class="row g-0 my-3 border-bottom pb-3">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B32">B32</h4>
                </div>
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B32.jpg') }}" />
                </div>
            </div>

            <div class="row g-0 my-3">
                <div class="col-4">
                    <img class="img-fluid" lazysrc="{{ asset('img/campgrounds/thumbnail/B33-B37.jpg') }}" />
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h4 id="B33-B37">B33 - B37</h4>
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