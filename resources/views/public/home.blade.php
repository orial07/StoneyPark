<x-app>
    <div class="hero">
        <video poster="{{ asset('img/banner.jpg') }}" class="img-fluid" crossorigin="anonymous" autoplay muted loop preload="auto">
            <source src="{{ asset('img/video/sunrise.mp4') }}" type='video/mp4'>
        </video>
        <div class="descriptor w-100 text-center">
            <h1 class="ff-serif display-1 fw-bold">{{ config('app.name') }}</h1>
            <p>Open from May 2021 until September 2021 via reservation</p>
            <a href="{{ route('reserve') }}" class="btn btn-primary">Reserve Now!</a>
        </div>
    </div>

    <div class="container">

        <div class="row justify-content-center my-5">
            <div class="col-10 text-center">
                <h3>Welcome to Stoney Park Campgrounds!</h3>
                <p>
                    For the first time in over 20 years the park will be opening its gates to the public. We have been
                    working day and night for the past year to make this happen. Originally we were set to open in the Spring of
                    2022 but we have pushed our agenda to allow visitors the chance to visit in 2021. This Spring we are
                    welcoming the general public to come enjoy 100 camping spots each equipped with a picnic table and firepit
                    along with over 700 acres of land to explore!
                </p>
            </div>
        </div>

        <x-socials>
            <h2 class="text-center my-4">Find us on social media</h2>
        </x-socials>
    </div>
</x-app>
