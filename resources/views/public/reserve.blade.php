<x-app>
    @section('title', '- Reserve')

    @section('head')
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <x-errors></x-errors>

        <form name="reserve_form" method="POST" action="reserve">
            @csrf

            <div class="bs-stepper row g-0 m-0">
                <div class="bs-stepper-header my-5" role="tablist">
                    <x-controls.stepper-header class="active" :step="1">Name</x-controls.stepper-header>
                    <div class="bs-stepper-line"></div>
                    <x-controls.stepper-header :step="2">Reservation</x-controls.stepper-header>
                    <div class="bs-stepper-line"></div>
                    <x-controls.stepper-header :step="3">Review</x-controls.stepper-header>
                </div><!-- stepper nav end -->

                <div class="bs-stepper-content">

                    <x-controls.stepper-step class="active" :step="1">
                        <div class="row justify-content-center">
                            <div class="col-md col-lg-6">

                                <!-- Customer Name -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Name</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name"
                                        autofocus required value="{{ old('first_name') }}" />
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                        required value="{{ old('last_name') }}" />
                                </div>

                                <!-- Customer Email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="example@hotmail.com"
                                        name="email" required value="{{ old('email') }}">
                                </div>

                                <!-- Customer Phone -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Phone</span>
                                    </div>
                                    <input type="tel" class="form-control" placeholder="123 456 7890" name="phone"
                                        required value="{{ old('phone') }}">
                                </div>

                                <!-- Customer Age -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Age</span>
                                    </div>
                                    <input type="number" class="form-control" min="18" value="18" name="age"
                                        autocomplete="false" required>
                                </div>

                                <!-- Number of campers -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Number of Campers</span>
                                    </div>
                                    <input type="number" class="form-control" name="campers" value="1" min="1" max="6"
                                        autocomplete="false">
                                    <small class="form-text text-muted w-100">The amount of people staying, including
                                        yourself.</small>
                                </div>

                                <div class="container" id="campers">
                                </div>

                                <button type="button" class="btn btn-primary float-end"
                                    onclick="stepper.next()">Next</button>
                            </div>
                        </div>
                    </x-controls.stepper-step>

                    <x-controls.stepper-step class="dstepper-none" :step="2">

                        <!-- Reservation dates -->
                        <div class="row justify-content-center">
                            <div class="col col-sm-8 col-lg-6">
                                <p>Selected reservation dates are nights you stay. The date for arrival will be <span
                                        class="text-primary" id="date_arrive"></span> and <span class="text-primary"
                                        id="date_depart"></span> is the date you leave (the morning after your last
                                    night).</p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col col-sm-8 col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Reservation</span>
                                    </div>
                                    <input type="text" class="form-control" name="dates" required autocomplete="off">
                                    <small class="form-text text-center text-muted w-100">This reservation will be for
                                        <strong><span id="nights"></span></strong></small>
                                </div>
                            </div>
                        </div>

                        <!-- Camping Type -->
                        <fieldset class="form-group my-4">
                            <div class="g-2 row justify-content-around text-center">
                                <div class="col-xs-12 col-md-3 card">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ct_single"
                                        value="0" checked>
                                    <h2>$39</h2>
                                    <label role="button" class="stretched-link fs-5" for="ct_single">Single Medium
                                        Tent</label>
                                    <small>$39 per night</small>
                                    <p>One tent allowed on campsite.</p>
                                </div>
                                <div class="col-xs-12 col-md-3 card">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ct_double"
                                        value="1">
                                    <h2>$69*</h2>
                                    <label role="button" class="stretched-link fs-5" for="ct_double">Extra Medium
                                        Tent</label>
                                    <small>*$39 per night, $30 one-time fee</small>
                                    <p>Two tents allowed on campsite.</p>
                                </div>
                                <div class="col-xs-12 col-md-3 card">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ct_rv"
                                        value="2">
                                    <h2>$69</h2>
                                    <label role="button" class="stretched-link fs-5" for="ct_rv">Recreational
                                        Vehicle</label>
                                    <small>$69 per night</small>
                                    <p>Recreational vehicles (RV) only.</p>
                                </div>
                            </div>
                        </fieldset>

                        @auth
                            @if (auth()->user()->web_admin)
                                <div id="map" class="my-5 w-100 h-100" style="min-height: 75vh"></div>
                            @endif
                        @endauth

                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <button type="button" class="btn btn-primary float-end" onclick="stepper.next()">Next</button>
                    </x-controls.stepper-step>

                    <x-controls.stepper-step class="dstepper-none" :step="3">
                        <div class="row justify-content-center">
                            <div class="col-md col-lg-8">
                                <p>Please make sure all information shown is correct before proceeding with payment.</p>
                                <dl class="row">
                                    <dt class="col-sm-3">Name</dt>
                                    <dd class="col-sm-9"><span id="r_customer_name"></span></dd>

                                    <dt class="col-sm-3">Email</dt>
                                    <dd class="col-sm-9"><span id="r_customer_email"></span></dd>

                                    <dt class="col-sm-3">Phone</dt>
                                    <dd class="col-sm-9"><span id="r_customer_phone"></span></dd>

                                    <dt class="col-sm-3">Arrival</dt>
                                    <dd class="col-sm-9"><span id="r_arrival"></span></dd>

                                    <dt class="col-sm-3">Departure</dt>
                                    <dd class="col-sm-9"><span id="r_departure"></span></dd>
                                </dl>

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
                                            <td><span id="r_nights_qty"></span></td>
                                            <td>$<span id="r_nights_cost"></span></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"><span id="r_camping_type"></span></td>
                                            <td><span id="r_camping_type_qty"></span></td>
                                            <td>$<span id="r_camping_type_cost"></span></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"><strong>Total</strong></td>
                                            <td></td>
                                            <td>
                                                <strong>
                                                    <small class="text-muted" id="total">Calculating...</small>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary"
                                    onclick="stepper.previous()">Previous</button>
                                <button type="submit" class="btn btn-success float-end">Pay now</button>
                            </div>
                        </div> <!-- row end -->

                    </x-controls.stepper-step>
                </div>
            </div>
        </form>

    </div>

    <!-- Map Modal -->
    <div class="modal fade" id="maps-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="properties" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-name"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9" id="modal-description"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="{{ asset('js/checkout.js') }}"></script>

        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRE6SEIjNbmklk--s8yVx3XbyRmzC3yNM&callback=initMap&v=weekly"
            async>
        </script>
        <script src="{{ asset('js/map.js') }}"></script>
    @endsection
</x-app>
