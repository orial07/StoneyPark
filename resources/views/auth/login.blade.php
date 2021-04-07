<x-app>
    <div class="container mt-4">
        <div class="row justify-content-center g-0">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <h4 class="fw-bold text-center m-4">Log In</h4>

                <x-errors :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <x-controls.input id="email" type="email" required autocomplete>{{ __('Email') }}</x-controls.input>
                    <x-controls.input id="password" type="password" required>{{ __('Password') }}</x-controls.input>
                    <small class="d-block w-100">
                        @if (Route::has('password.request'))
                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                        @endif
                    </small>

                    <!-- Remember Me -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="text-center my-4">
                        <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>