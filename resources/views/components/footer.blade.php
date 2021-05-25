<footer class="container-md container-sm-fluid">
    <hr class="featurette-divider" />
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <small>&copy; 2021 {{ config('app.name') }}</small>
            </div>
            <div class="col">
                <p class="fw-bold">Follow Us</p>
                <ul class="list-unstyled text-small">
                    <li><a href="{{ config('app.socials.instagram') }}" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
            <div class="col">
                <p class="fw-bold">Account</p>
                <ul class="list-unstyled text-small">
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @endguest
                    @auth
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                    <li><a href="{{ route('account') }}">My Account</a></li>
                    @if (auth()->user()->web_admin)
                    <li><a href="{{ route('admin') }}">Admin Panel</a></li>
                    @endif
                    @endauth
                </ul>
            </div>
            <div class="col">
                <p class="fw-bold">Explore</p>
                <ul class="list-unstyled text-small">
                    <li><a href="{{ route('reserve') }}">Reserve</a></li>
                    <li><a href="{{ route('rules') }}">Rules</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>