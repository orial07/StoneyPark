<x-app>
    <div class="hero">
        <video class="img-fluid" crossorigin="anonymous" autoplay muted loop preload="auto"
            src="{{ asset('img/video/sunrise.mp4') }}">
        </video>
        <div class="descriptor w-100 text-center">
            <h1 class="ff-serif display-1 fw-bold">{{ config('app.name') }}</h1>
            <p>Open From May 2021 until September 2021 via reservation</p>
            <a href="{{ route('reserve') }}" class="btn btn-primary">Reserve Now!</a>
        </div>
    </div>

    <div class="container">
        <x-socials>
            <h1 class="text-center my-4">Find us on social media</h1>
        </x-socials>
    </div>
</x-app>
