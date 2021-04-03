<x-app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="d-flex align-items-center">
                    <img class="m-5" style="height: 8rem;" src="{{ asset('img/confused.svg') }}" />
                    <h1>Error &HorizontalLine; 404</h1>
                </div>
                <p class="display-6">We don't know where that page is.</p>
                <p>You can try <a href="{{ url()->previous() }}">going back</a>, otherwise we recommend going back to
                    the <a href="{{ url('/') }}">home page</a>.</p>
            </div>
        </div>
    </div>
</x-app>
