<x-app-dashboard>
    <form method="POST" action="{{ route('dashboard') }}">
        @csrf

        <!-- Name -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __('Name') }}</span>
            </div>
            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" disabled>
        </div>


        <!-- Email Address -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __('Email') }}</span>
            </div>
            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __('Password') }}</span>
            </div>
            <input type="password" class="form-control" name="password" required>
        </div>

        <!-- New Password -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __('New Password') }}</span>
            </div>
            <input type="password" class="form-control" name="new-password" required>
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
                <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
            </div>
        </div>
    </form>
</x-app-dashboard>