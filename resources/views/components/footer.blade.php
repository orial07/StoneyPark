<footer class="container-md container-sm-fluid">
    <hr class="featurette-divider" />
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <small>&copy; 2021 {{ config('app.name') }}</small>
            </div>
            <div class="col">
                <ul class="list-unstyled text-small">
                    @guest
                    <li><a class="text-muted" href="{{ route('login') }}">Login</a></li>
                    @endguest
                </ul>
            </div>
            <div class="col">
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="{{ route('reserve') }}">Reserve</a></li>
                    <li><a class="text-muted" href="{{ route('rules') }}">Rules</a></li>
                    <li><a class="text-muted" href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a class="text-muted" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
