<x-app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <img class="m-5" style="height: 8rem;" src="{{ asset('img/confused.svg') }}" />
                <p class="display-6">Sorry! We couldn't find that page.</p>
                <p>You can try <a href="{{ url()->previous() }}">going back</a>, otherwise we recommend going back to
                    the <a href="{{ url('/') }}">home page</a>.</p>
            </div>
        </div>
    </div>
</x-app>
