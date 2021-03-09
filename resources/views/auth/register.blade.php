<x-app>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Name') }}</span>
                        </div>
                        <input type="text" class="form-control" name="name" :value="old('name')" required>
                    </div>


                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Email') }}</span>
                        </div>
                        <input type="email" class="form-control" name="email" :value="old('email')" required>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Password') }}</span>
                        </div>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Confirm Password') }}</span>
                        </div>
                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <div class="text-center my-4">
                            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>