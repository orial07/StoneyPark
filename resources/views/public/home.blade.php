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
            <div class="w-100">
                <hr>
            </div>
            <div class="col-10 text-center">
                <h3>Where you can find us</h3>
                <p>You can find us at <a href="https://goo.gl/maps/ZJxecqCRmiBxJdq18"><i class="fas fa-map-marker-alt"></i> Stoney 142, 143, 144, AB</a></p>
                <iframe class="mw-100 w-100" height="400" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9633.090248066968!2d-114.99912450019522!3d51.14868292939065!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTHCsDA4JzU3LjAiTiAxMTTCsDU5JzU0LjQiVw!5e0!3m2!1sen!2sca!4v1620948347902!5m2!1sen!2sca" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <x-socials>
            <h2 class="text-center my-4">Find us on social media</h2>
        </x-socials>
    </div>
</x-app>