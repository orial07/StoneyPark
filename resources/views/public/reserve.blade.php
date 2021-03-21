<x-app>
    @section('head')
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />
        <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <x-errors></x-errors>

        <div class="row">
            @env('local')
            <div class="order-1 order-md-0 col-md-5 col-lg">
                <div id="map" class="h-100" style="min-height: 80vh;"></div>
            </div>
            @endenv
            <div class="order-0 col">
                <form name="reserve_form" method="POST" action="reserve">
                    @csrf
                    <!-- Customer Name -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Name</span>
                        </div>
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" autofocus
                            required />
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required />
                    </div>

                    <!-- Customer Email -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</span>
                        </div>
                        <input type="email" class="form-control" placeholder="example@hotmail.com" name="email"
                            required>
                    </div>

                    <!-- Customer Phone -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Phone</span>
                        </div>
                        <input type="tel" class="form-control" placeholder="123 456 7890" name="phone" required>
                    </div>

                    <!-- Customer Age -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Age</span>
                        </div>
                        <input type="number" class="form-control" min="18" value="18" name="age" autocomplete="false"
                            required>
                    </div>

                    <!-- Camping Type -->
                    <fieldset class="form-group mb-3">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Campground</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ctSingle"
                                        value="0" checked>
                                    <label class="form-check-label" for="ctSingle">Medium-sized Tent</label>
                                    <small class="text-muted form-text">&HorizontalLine; $39 per night</small>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ctDouble"
                                        value="1">
                                    <label class="form-check-label" for="ctDouble">Extra Medium-sized Tent</label>
                                    <small class="text-muted form-text">&HorizontalLine; $30 flat fee</small>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="camping_type" id="ctRV"
                                        value="2">
                                    <label class="form-check-label" for="ctRV">RV Spot</label>
                                    <small class="text-muted form-text">&HorizontalLine; $69 per night</small>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Reservation dates -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Reservation</span>
                        </div>
                        <input type="text" class="form-control" name="dates" required>
                        <small class="form-text text-muted w-100" id="day_count"></small>
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

                    <h3>Total: <small class="text-muted" id="total">Calculating...</small></h3>

                    <button type="submit" class="btn btn-primary">Pay now</button>
                </form>
            </div>
        </div>

        @section('scripts')
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js">
            </script>
            <script src="{{ asset('js/checkout.js') }}"></script>

            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>
            <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
            <script src="{{ asset('js/map.js') }}"></script>
            <script>
                (function(j) {
                    if (!j || !j.features) return;
                    L.geoJSON(JSON.parse(j), {
                        onEachFeature: onEachFeature
                    }).addTo(map);
                })('{!! $geomap !!}');

                function onEachFeature(feature, layer) {
                    if (!feature.properties) return;
                    if (feature.properties.popupContent) layer.bindPopup(getPopupTemplate({
                        "name": feature.properties.name,
                        "popupContent": feature.properties.popupContent,
                    }));
                }

            </script>
        @endsection
</x-app>
