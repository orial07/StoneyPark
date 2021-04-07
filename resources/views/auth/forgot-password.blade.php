<x-app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <h4 class="fw-bold text-center m-4">Reset Password</h4>
                <div class="mb-4">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset
                    link that will allow you to choose a new one.
                </div>

                <x-errors :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <x-controls.input id="email" type="email">
                        {{ __('Email') }}
                    </x-controls.input>

                    <div class="d-grid">
                        <x-controls.button type="submit">Submit</x-controls.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
