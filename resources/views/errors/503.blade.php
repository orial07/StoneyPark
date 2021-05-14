<x-app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="d-flex align-items-center">
                    <img class="m-5" style="height: 8rem;" src="{{ asset('img/svg/smiling.svg') }}" />
                    <h1>Everything's Fine!</h1>
                </div>
                <p class="lead">Sorry for the inconvenience but the site is under maintenance at the moment. If you need to, you can always
                    <a href="mailto:{{ config('mail.bcc') }}">contact us</a>, otherwise we&rsquo;ll be back online
                    shortly!
                </p>
            </div>
        </div>
    </div>
</x-app>
