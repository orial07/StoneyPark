<x-app-dashboard>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4 text-center">Welcome back, {{ Auth::user()->name }}</h1>
        </div>
      </div>

    <form method="POST" action="{{ route('dashboard') }}">
        @csrf

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