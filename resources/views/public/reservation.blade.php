<x-app>
    <div class="container mt-4">
        <div class="row">
            <div class="col card mx-md-4">
                <div class="card-body">
                    <h3 class="title">Reservation</h3>
                    <hr />
                    <p><span class="text-muted">Arrival</span> <?= date('Y-m-d (l F j)', strtotime($reservation->date_in)) ?></p>
                    <p><span class="text-muted">Departure</span> <?= date('Y-m-d (l F j)', strtotime($reservation->date_out)) ?></p>
                </div> <!-- card body end -->
            </div> <!-- card/column end -->
            
            <div class="col card mx-4">
                <div class="card-body">
                    <h3 class="title">Customer</h3>
                    <hr />
                    <p class="lead">{{ $reservation->first_name }} {{ $reservation->last_name }}</p>

                    <p>
                        <span class="text-muted">Email</span>
                        <a href="mailto:{{ $reservation->email }}">{{ $reservation->email }}</a>
                    </p>

                    <p>
                        <span class="text-muted">Phone</span>
                        <a href="tel:{{ $reservation->phone }}">{{ $reservation->phone }}</a>
                    </p>

                    <p><span class="text-muted">Age</span> {{ $reservation->age }}</p>
                </div> <!-- card body end -->
            </div> <!-- column/card end -->
        </div> <!-- row end -->

        <div class="my-5">
            <h3 class="title">Campers</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < sizeof($campers); $i++)
                        <tr>
                            <th scope="row">{{ $i + 1 }}</th>
                            <td>{{ $campers[$i]->first_name }}</td>
                            <td>{{ $campers[$i]->last_name }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="my-5">
            <h3 class="title">Pricing</h3>
            <hr />
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Nights reserved</td>
                        <td>{{ $nights }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        @if ($reservation->camping_type != 2)
                            <td scope="row">Medium tent</td>
                            <td>{{ $reservation->camping_type == 0 ? 1 : 2 }}</td>
                            <td>$39</td>
                        @else
                            <td scope="row">RV spot</td>
                            <td>1</td>
                            <td>$69</td>
                        @endif
                    </tr>
                    @if ($reservation->camping_type == 1)
                        <tr>
                            <td scope="row">Extra medium tent</td>
                            <td>1</td>
                            <td>$30</td>
                        </tr>
                    @endif
                    <tr>
                        <td scope="row"><strong>Total</strong></td>
                        <td></td>
                        <td><strong>${{ $cost }}</strong></td>
                    </tr>
                </tbody>
            </table>    
        </div>    
    </div> <!-- container end -->
</x-app>

