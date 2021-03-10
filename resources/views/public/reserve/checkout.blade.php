<x-app>
    <div class="container mt-4">
        <h1 class="lead text-center">Please wait while we process your request...</h1>
    </div>
    @section('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            $(document).ready(function() {
                let stripe = Stripe(
                    'pk_test_51IQKjxGaEEo7pe6EXOsd3LTD8cgYTWx5NNmX0GPKN55OwL53cSPr7ynY8U31e7xpUQmnBQcyqUpwbAOE7xRXszXm00W6BUZ0Q6'
                );
                // literally just wait for redirect *yawn*
                stripe.redirectToCheckout({
                    sessionId: "{{ $id }}"
                });
            });

        </script>
    @endsection
</x-app>
