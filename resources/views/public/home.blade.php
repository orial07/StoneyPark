<x-app>
    <x-carousel :carousel="$carousel" />

    <div class="container marketing">
        <x-socials>
            <h2 class="text-center display-4 p-5">Find us on social media</h2>
        </x-socials>


        <div class="row">
            <hr class="featurette-divider" />
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
            <hr class="featurette-divider" />
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
