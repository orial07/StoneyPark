<x-app>
    <div class="container mt-4">
        <h1 class="lead text-center">Please wait while we process your request...</h1>
    </div>
    @section('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            $(document).ready(function() {
                let stripe = Stripe("{{ env('STRIPE_KEY') }}");
                // literally just wait for redirect *yawn*
                stripe.redirectToCheckout({
                    sessionId: "{{ $checkout_session->id }}"
                });
            });

        </script>
    @endsection
</x-app>
