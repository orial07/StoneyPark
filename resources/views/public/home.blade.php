<x-app>
    <x-carousel :carousel="$carousel" />

    <div class="container marketing">
        <div class="row justify-content-center">
            <h2 class="text-center display-4 mb-4">Find us on social media</h2>
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
        </div><!-- media end -->


        <div class="row">
            <hr class="featurette-divider">
            <div class="col-md-7">
                <h2 class="featurette-heading">The view? <span class="text-muted">We got that.</span></h2>
                <p class="lead">See beautiful mountains, tall trees and acres of greenery.</p>
                <p><a class="btn btn-lg btn-primary" href="{{ route('gallery') }}">Browse gallery</a></p>
            </div>
            <div class="col-md-5">
                <img class="h-100 img-fluid mx-auto" src="{{ asset('img/market1.jpg') }}" />
            </div>
        </div>

        <div class="row">
            <hr class="featurette-divider">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Not convinced? <span class="text-muted">See for yourself.</span></h2>
                <p class="lead">Reservations are just a click away. Simple and fast.</p>
                <p><a class="btn btn-lg btn-primary" href="{{ route('reserve') }}">Reserve</a></p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="h-100 img-fluid mx-auto" src="{{ asset('img/market2.jpg') }}" />
            </div>
        </div>
    </div>
</x-app>
