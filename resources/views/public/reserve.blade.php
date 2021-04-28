<x-app>
    @section('title', 'Reserve')

    @section('head')
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <div class="text-center">
            <p>By reserving, you also agree to abide by <a href="https://www.alberta.ca/enhanced-public-health-measures.aspx"
                    target="_blank">Alberta's COVID Regulations</a> and
                our <a href="{{ route('rules') }}" target="_blank">rules &amp; policies</a>
            </p>
        </div>

        <x-errors></x-errors>

        <form id="reserve-form" method="POST" action="reserve">
            @csrf

            <div class="bs-stepper row g-0 m-0">
                <div class="bs-stepper-header mb-3" role="tablist">
                    <x-controls.stepper-header class="active" :step="1">Reservation</x-controls.stepper-header>
                    <div class="bs-stepper-line"></div>
                    <x-controls.stepper-header :step="2">Profile</x-controls.stepper-header>
                    <div class="bs-stepper-line"></div>
                    <x-controls.stepper-header :step="3">Review</x-controls.stepper-header>
                </div><!-- stepper nav end -->

                <div class="bs-stepper-content">

                    <x-controls.stepper-step class="active" :step="1">
                        <h3 class="text-center mb-5">How long will you be camping?</h3>

                        <!-- Reservation dates -->
                        <div class="row justify-content-center">
                            <div class="col col-sm-8 col-lg-4">
                                <x-controls.input id="dates" type="text" required>
                                    {{ __('Reservation Dates') }}
                                </x-controls.input>
                                <p class="text-center" id="nights"></p>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center">
                            <div class="col col-sm-10 col-md-8">
                                Reservation dates include the date you arrive and depart.
                                <p class="d-none" id="date_display">
                                    You can arrive on <span class="text-primary" id="date_arrive"></span>, the date you
                                    leave is the morning of <span class="text-primary" id="date_depart"></span>.
                                </p>
                            </div>
                        </div>

                        <!-- Camping Types -->
                        <fieldset>
                            <div class="g-2 row justify-content-center gap-sm-2 gap-md-5 text-center">
                                @foreach (ReservationUtil::getCampingTypes() as $ct)
                                    <x-controls.camping-type-radio :i="$loop->iteration - 1" :ct="$ct">
                                    </x-controls.camping-type-radio>
                                @endforeach
                            </div>
                        </fieldset>

                        @auth
                            <div id="map" class="my-5 w-100 h-100" style="min-height: 75vh"></div>
                        @endauth

                        <button type="button" class="btn btn-primary float-end" onclick="stepper.next()">Next</button>
                    </x-controls.stepper-step>

                    <x-controls.stepper-step class="dstepper-none" :step="2">
                        <div class="row justify-content-center">
                            <div class="col-md col-lg-6">
                                <h2 class="text-center mb-5">Who is reserving?</h2>

                                <x-controls.input id="first_name" type="text" placeholder="First Name" required
                                    autocomplete>{{ __('First Name') }}</x-controls.input>

                                <x-controls.input id="last_name" type="text" placeholder="Last Name" required
                                    autocomplete>{{ __('Last Name') }}</x-controls.input>

                                <x-controls.input id="email" type="email" placeholder="To send your confirmation"
                                    required autocomplete>{{ __('Email Address') }}</x-controls.input>

                                <x-controls.input id="phone" type="tel" placeholder="To contact you" required
                                    autocomplete>{{ __('Phone Number') }}</x-controls.input>

                                <x-controls.input id="age" type="number" value="18" min="18" required>
                                    {{ __('Age') }}</x-controls.input>

                                <x-controls.input id="campers_count" type="number" value="1" min="1" max="6" required>
                                    {{ __('Number of Campers') }}<small class="form-text text-muted w-100">(including
                                        yourself)</small>
                                </x-controls.input>
                                <div class="container" id="campers"></div>

                                <button type="button" class="btn btn-primary"
                                    onclick="stepper.previous()">Previous</button>
                                <button type="button" class="btn btn-primary float-end"
                                    onclick="stepper.next()">Next</button>
                            </div>
                        </div>
                    </x-controls.stepper-step>

                    <x-controls.stepper-step class="dstepper-none" :step="3">
                        <div class="row justify-content-center">
                            <div class="col-md col-lg-8">
                                <dl class="row">
                                    <dt class="col-sm-3">Name</dt>
                                    <dd class="col-sm-9" id="r_customer_name"></dd>

                                    <dt class="col-sm-3">Email</dt>
                                    <dd class="col-sm-9" id="r_customer_email"></dd>

                                    <dt class="col-sm-3">Phone</dt>
                                    <dd class="col-sm-9" id="r_customer_phone"></dd>

                                    <dt class="col-sm-3">Arrival</dt>
                                    <dd class="col-sm-9" id="r_arrive"></dd>

                                    <dt class="col-sm-3">Departure</dt>
                                    <dd class="col-sm-9" id="r_depart"></dd>
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
                                            <td id="r_nights_qty"></td>
                                            <td id="r_nights_cost"></td>
                                        </tr>
                                        <tr>
                                            <td scope="row" id="r_camping_name"></td>
                                            <td id="r_camping_qty"></td>
                                            <td id="r_camping_cost"></td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td scope="row">GST</td>
                                            <td></td>
                                            <td id="r_gst"></td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td scope="row">Total</td>
                                            <td></td>
                                            <td id="r_total"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="button" class="btn btn-primary"
                                    onclick="stepper.previous()">Previous</button>
                                <div class="float-end text-end">
                                    <button type="submit" class="btn btn-success">Pay now</button>
                                    </small>
                                </div>
                            </div>
                        </div> <!-- row end -->

                    </x-controls.stepper-step>
                </div>
            </div>
        </form>
    </div>

    @auth
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
    @endauth

    @section('scripts')
        <script>
            const CAMPING_TYPES = {!! json_encode(ReservationUtil::getCampingTypes()) !!};

        </script>
        <script src="{{ asset('js/checkout.js') }}"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        @auth
            <!-- google maps -->
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRE6SEIjNbmklk--s8yVx3XbyRmzC3yNM&callback=initMap&v=weekly"
                async>
            </script>
            <script src="{{ asset('js/map.js') }}"></script>
        @endauth
    @endsection
</x-app>
