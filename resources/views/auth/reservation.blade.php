<x-app>
    <div class="container mt-4">

        <div class="row gap-3 justify-content-center">
            <div class="col-5">
                <x-errors></x-errors>
            </div>

            <div class="w-100"></div>
            <div class="col-xs-6 col-lg-5 card">
                <div class="card-body">
                    <h3 class="title">Reservation <span class="text-muted">#{{ $reservation->id }}</span></h3>
                    <hr />
                    <dl class="row">
                        <dt class="col-sm-4">Transaction ID</dt>
                        <dd class="col-sm-8 user-select-all">{{ $reservation->transaction_id }}</dd>

                        <dt class="col-sm-4">Arrival</dt>
                        <dd class="col-sm-8"><?= date('F j, Y (m-d-Y)', strtotime($reservation->date_in)) ?></dd>

                        <dt class="col-sm-4">Departure</dt>
                        <dd class="col-sm-8"><?= date('F j, Y (m-d-Y)', strtotime($reservation->date_out)) ?></dd>

                        <dt class="col-sm-4">Campsite</dt>
                        <dd class="col-sm-8">{{ $reservation->campground_id }}</dd>
                    </dl>

                    <a href="{{ route('admin.reservations.email', $reservation->id) }}" class="btn btn-primary">Send Receipt</a>
                </div> <!-- card body end -->
            </div> <!-- card/column end -->

            <div class="col-xs-6 col-lg-5 card">
                <div class="card-body">
                    <h3 class="title">Customer</h3>
                    <hr />
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
</x-app>