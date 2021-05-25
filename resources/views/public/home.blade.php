<x-app>
    <div class="hero">
        <video poster="{{ asset('img/banner.jpg') }}" class="img-fluid" crossorigin="anonymous" autoplay muted loop preload="auto">
            <source src="{{ asset('img/video/sunrise.mp4') }}" type='video/mp4'>
        </video>
        <div class="descriptor w-100 text-center">
            <h1 class="ff-serif display-1 fw-bold">{{ config('app.name') }}</h1>
            <p>Open from May to October 2021 via reservation</p>
            <a href="{{ route('reserve') }}" class="btn btn-primary">Reserve Now!</a>
        </div>
    </div>

    <div class="container">

        <div class="row justify-content-center my-5">
            <div class="col-10">
                <h1 class="text-center">Welcome to Stoney Park Campgrounds!</h1>
                <p>
                    For the first time in over 20 years the park will be opening to the public. We have been working day and night for the past year to make this happen. Originally we were set to open in the spring of 2022 but have pushed the agenda to allow visitors the chance to visit in 2021.
                    <br><br>
                    Spring 2021 we are welcoming everyone to enjoy 100 camping spots, with more to come later this year, and the next! Every campsite is equipped with a picnic table and fire pit. Trailers and RV camping will be available in spring 2022. We're working hard every day to give our campers the best and most comfortable camping experience possible.
                    <br><br>
                    With a fire pit in every campsite, beautiful hills, mountains, rivers, and over 600 acres of unexplored land to hike, we hope you enjoy your marshmallows (and your stay) at Stoney Campgrounds!
                </p>
            </div>
            <div class="w-100">
                <hr>
            </div>
            <div class="col-10 text-center">
                <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                <p>
                    Campers visiting from Calgary can expect up to a 60 minute drive, and 15 &HorizontalLine; 30 minute drive from campgrounds to Kananaskis.<br>
                    Our park can be found at <a href="https://goo.gl/maps/ZJxecqCRmiBxJdq18">Stoney 142, 143, 144, AB</a> along Alberta Highway 1A .
                </p>

                <iframe class="mw-100 w-100 shadow" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10012.059942042568!2d-115.00073440111706!3d51.14507476438579!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5371270862209493%3A0x9c3d4f3fba281f93!2sStoney%20Park%20Campgrounds!5e0!3m2!1sen!2sca!4v1621284575713!5m2!1sen!2sca" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <x-socials>
            <h2 class="text-center my-4">Find us on social media</h2>
        </x-socials>
    </div>
</x-app>