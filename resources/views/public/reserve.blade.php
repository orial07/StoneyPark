<x-app>
    @section('title', 'Reserve')

    @section('head')
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
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
                            </div>
                        </div>
                        <div class="row justify-content-center text-center">
                            <div class="col col-sm-10 col-md-8">
                                <p class="text-center" id="nights"></p>
                                <p>*You can arrive on <span class="text-primary" id="date_arrive"></span>, the date you
                                    leave will be the morning of <span class="text-primary" id="date_depart"></span>.
                                </p>
                            </div>
                        </div>

                        <!-- Camping Type -->
                        <fieldset class="form-group my-4">
                            <div class="g-2 row justify-content-around text-center">
                                <div class="col-xs-12 col-md-3 card">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ct_single"
                                        value="0" checked>
                                    <h2>$<span id="ct_total_single">39</span></h2>
                                    <label role="button" class="stretched-link fs-5" for="ct_single">Single Medium
                                        Tent</label>
                                    <small>$39 per night</small>
                                    <p class="py-3">One tent allowed on campsite.</p>
                                </div>
                                <div class="col-xs-12 col-md-3 card">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ct_double"
                                        value="1">
                                    <h2>$<span id="ct_total_double">69</span>*</h2>
                                    <label role="button" class="stretched-link fs-5" for="ct_double">Extra Medium
                                        Tent</label>
                                    <small>*$39 per night, $30 one-time fee</small>
                                    <p class="py-3">Two tents allowed on campsite.</p>
                                </div>
                                <div class="col-xs-12 col-md-3 card">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ct_rv"
                                        value="2">
                                    <h2>$<span id="ct_total_rv">69</span></h2>
                                    <label role="button" class="stretched-link fs-5" for="ct_rv">Recreational
                                        Vehicle</label>
                                    <small>$69 per night</small>
                                    <p class="py-3">Recreational vehicles (RV) only.</p>
                                </div>
                            </div>
                        </fieldset>

                        @auth
                            @if (auth()->user()->web_admin)
                                <div id="map" class="my-5 w-100 h-100" style="min-height: 75vh"></div>
                            @endif
                        @endauth

                        <button type="button" class="btn btn-primary float-end" onclick="stepper.next()">Next</button>
                    </x-controls.stepper-step>

                    <x-controls.stepper-step class="dstepper-none" :step="2">
                        <div class="row justify-content-center">
                            <div class="col-md col-lg-6">
                                <h2 class="text-center mb-5">Who is reserving?</h2>

                                <x-controls.input id="first_name" type="text" placeholder="First Name" required
                                    autocomplete>
                                    {{ __('First Name') }}
                                </x-controls.input>


                                <x-controls.input id="last_name" type="text" placeholder="Last Name" required
                                    autocomplete>
                                    {{ __('Last Name') }}
                                </x-controls.input>


                                <x-controls.input id="email" type="email" placeholder="To send your confirmation"
                                    required autocomplete>
                                    {{ __('Email Address') }}
                                </x-controls.input>


                                <x-controls.input id="phone" type="tel" placeholder="To contact you" required
                                    autocomplete>
                                    {{ __('Phone Number') }}
                                </x-controls.input>


                                <x-controls.input id="age" type="number" value="18" min="18" required>
                                    {{ __('Age') }}
                                </x-controls.input>


                                <x-controls.input id="campers_count" type="number" value="1" min="1" max="6" required>
                                    {{ __('Number of Campers') }}
                                    <small class="form-text text-muted w-100">(including
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
                                    <dd class="col-sm-9"><span id="r_customer_name"></span></dd>

                                    <dt class="col-sm-3">Email</dt>
                                    <dd class="col-sm-9"><span id="r_customer_email"></span></dd>

                                    <dt class="col-sm-3">Phone</dt>
                                    <dd class="col-sm-9"><span id="r_customer_phone"></span></dd>

                                    <dt class="col-sm-3">Arrival</dt>
                                    <dd class="col-sm-9"><span id="r_arrive"></span></dd>

                                    <dt class="col-sm-3">Departure</dt>
                                    <dd class="col-sm-9"><span id="r_depart"></span></dd>
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
                                <div class="float-end text-end">
                                    <button type="submit" class="btn btn-success">Pay now</button>
                                    <small class="d-block w-100 my-3">
                                        By reserving, you also agree to our
                                        <a href="{{ route('rules') }}" target="_blank">rules</a>.
                                    </small>
                                </div>
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

                        <dt class="col-sm-3">Ameneties</dt>
                        <dd class="col-sm-9">
                            <x-amenities></x-amenities>
                        </dd>
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
