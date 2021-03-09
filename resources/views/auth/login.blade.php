<x-app>
    <div class="container mt-4">
        <div class="row justify-content-center g-0">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{__('Email') }}</span>
                        </div>
                        <input type="email" class="form-control" name="email" :value="old('email')" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Password') }}</span>
                        </div>
                        <input type="password" class="form-control" name="password" required autocomplete="current-password">
                        <small class="d-block w-100">
                            @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                            @endif
                        </small>
                    </div>

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