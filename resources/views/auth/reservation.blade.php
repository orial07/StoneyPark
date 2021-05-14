<x-app>
    @section('head')
    <!-- date picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-5">
                <x-errors></x-errors>
            </div>

            <div class="w-100"></div>
            @if (auth()->user()->web_admin)
            <div class="col-12 col-md-4 card">
                <div class="card-body">
                    <h3 class="title">Tools</h3>
                    <hr>
                    <form class="row" method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
                        @csrf
                        <div class="col-12">
                            <x-controls.input id="dates" type="text" required>
                                <span for="dates">New Date</span>
                            </x-controls.input>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-primary">Change Dates</button>
                        </div>
                    </form>

                    @if ($reservation->transaction_id)
                    <hr>
                    <a href="{{ route('admin.reservations.email', $reservation->id) }}" class="btn btn-primary w-100">Send Receipt</a>
                    @endif

                    @if ($reservation->status == 'paid')
                    <hr>
                    <a href="{{ route('admin.reservations.cancel', $reservation->id) }}" class="btn btn-danger w-100">Cancel Reservation</a>
                    @endif
                </div>
            </div>
            @endif

            <div class="col-12 col-md-4 card">
                <div class="card-body">
                    <h3 class="title">Reservation <span class="text-muted">#{{ $reservation->id }}</span></h3>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ $reservation->status }}</dd>

                        <dt class="col-sm-4">Transaction ID</dt>
                        <dd class="col-sm-8 user-select-all">{{ $reservation->transaction_id }}</dd>

                        @if (auth()->user()->web_admin)
                        @if ($checkout)
                        <dt class="col-sm-4">Payment Intent</dt>
                        <dd class="col-sm-8 user-select-all">{{ $checkout->payment_intent }}</dd>
                        @endif
                        @endif

                        <dt class="col-sm-4">Arrival</dt>
                        <dd class="col-sm-8"><?= date('F j, Y (m-d-Y)', strtotime($reservation->date_in)) ?></dd>

                        <dt class="col-sm-4">Departure</dt>
                        <dd class="col-sm-8"><?= date('F j, Y (m-d-Y)', strtotime($reservation->date_out)) ?></dd>

                        <dt class="col-sm-4">Campsite</dt>
                        <dd class="col-sm-8">{{ $reservation->campground_id }}</dd>
                    </dl>
                </div> <!-- card body end -->
            </div> <!-- card/column end -->

            <div class="col-12 col-md-4 card">
                <div class="card-body">
                    <h3 class="title">Customer</h3>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $reservation->first_name }} {{ $reservation->last_name }}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">
                            <a href="mailto:{{ $reservation->email }}">{{ $reservation->email }}</a>
                        </dd>

                        <dt class="col-sm-3">Phone</dt>
                        <dd class="col-sm-9">
                            <a href="tel:{{ $reservation->phone }}">{{ $reservation->phone }}</a>
                        </dd>

                        <dt class="col-sm-3">Age</dt>
                        <dd class="col-sm-9">{{ $reservation->age }}</dd>
                    </dl>
                </div> <!-- card body end -->
            </div> <!-- column/card end -->
        </div> <!-- row end -->

        <div class="row gap-sm-5 gap-md-0 mt-5">
            <div class="col-xs-12 col-md-6">
                <h3 class="title">Campers</h3>
                <x-reservation.campers :campers="$reservation->campers"></x-reservation.campers>
            </div>

            <div class="col-xs-12 col-md-6">
                <h3 class="title">Pricing</h3>
                <x-reservation.receipt :reservation="$reservation"></x-reservation.receipt>
            </div>
        </div>
    </div> <!-- container end -->

    @section('scripts')
    <script>
        var reservation = {!! json_encode($reservation) !!};
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @endsection
</x-app>