<x-app>
    <div class="container mt-4">

        <div class="row gap-3 justify-content-center">
            <div class="col-xs-6 col-lg-5 card">
                <div class="card-body">
                    <h3 class="title">Reservation</h3>
                    <hr />
                    <dl class="row">
                        <dt class="col-sm-4">Arrival</dt>
                        <dd class="col-sm-8"><?= date('m-d-Y (F j, Y)', strtotime($reservation->date_in)) ?></dd>

                        <dt class="col-sm-4">Departure</dt>
                        <dd class="col-sm-8"><?= date('m-d-Y (F j, Y)', strtotime($reservation->date_out)) ?></dd>
                    </dl>
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

            <div class="col-xs-12 col-md-6">
                <h3 class="title">Pricing</h3>
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
        </div>

    </div> <!-- container end -->
</x-app>
