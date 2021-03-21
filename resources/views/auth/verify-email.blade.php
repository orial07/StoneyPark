<x-app>
    <div class="container-md container-sm-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-8">
                <h4>Hey {{ auth()->user()->name }},</h4>
                <p class="mb-4">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on
                    the link
                    we just emailed to you?
                </p>
                <p>If you didn't receive the email, we will gladly send you another.</p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        <p>A new verification link has been sent to the email address you provided during registration.
                        </p>
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-center">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button class="btn btn-primary">
                                Resend Verification Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
