<x-app>
    <div class="container mt-4">
        @if ($errors->any())
            @if ($errors->first() == 'success')
                <div class="alert alert-success">Booking request sent!</div>
            @else
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        <form name="reserve_form" method="POST" action="reserve">
            <!-- Customer Name -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="First Name" name="first_name" autofocus required />
                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required />
            </div>

            <!-- Customer Email -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="example@hotmail.com" name="email" required>
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
                <input type="number" class="form-control" min="18" value="18" name="age" autocomplete="false" required>
            </div>

            <!-- Camping Type -->
            <fieldset class="form-group mb-3">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Campground</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="campingType" id="ctSingle" value="0"
                                checked>
                            <label class="form-check-label" for="ctSingle">Medium-sized Tent</label>
                            <small class="text-muted form-text">&HorizontalLine; $39 per night</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="campingType" id="ctDouble" value="1">
                            <label class="form-check-label" for="ctDouble">Extra Medium-sized Tent</label>
                            <small class="text-muted form-text">&HorizontalLine; $30 flat fee</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="campingType" id="ctRV" value="2">
                            <label class="form-check-label" for="ctRV">RV Spot</label>
                            <small class="text-muted form-text">&HorizontalLine; $69 per night</small>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Check In date -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Check In</span>
                </div>
                <input type="date" class="form-control" name="date_in" required>
            </div>

            <!-- Check Out date -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Check Out</span>
                </div>
                <input type="date" class="form-control" name="date_out" required>
                <small class="form-text text-muted w-100" id="day_count"></small>
            </div>

            <!-- Number of campers -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Number of Campers</span>
                </div>
                <input type="number" class="form-control" name="campers" value="1" min="1" max="6" autocomplete="false">
                <small class="form-text text-muted w-100">The amount of people staying, including yourself.</small>
            </div>

            <div class="container" id="campers">
            </div>

            <h3>Total: <small class="text-muted" id="total">$0</small></h3>

            <button type="submit" class="btn btn-primary">Pay now</button>
            @csrf
        </form>
    </div>

    @section('scripts')
        <script>
            const Invoice = {
                'campingType': 0,
                'nightsReserved': 1,
                'campersCount': 0,
            };

            const form = document.reserve_form;
            const total = document.getElementById('total');

            $(document).ready(function() {
                // minimum 1 night of staying
                form.date_in.value = new Date().toISOString().substring(0, 10);
                form.date_out.value = new Date(Date.now() + 86400000).toISOString().substring(0, 10);

                update();

                form.addEventListener('change', function(e) {
                    if (e.target.name == 'campingType') onCampingTypeChanged(e.target);
                    else if (e.target.name.substring(0, 4) == 'date') onDateChanged(e.target);
                    else if (e.target.name == "campers") onCampersChanged(e.target);
                    update();
                });
            });

            const campingTypes = [
                39, // one tent is $39 per night
                39, // extra tent is a $30 flat fee
                69, // rv spot is $69 per night
            ];

            function onCampingTypeChanged(e) {
                // clamp value
                Invoice.campingType = Math.max(0, Math.min(campingTypes.length, parseInt(e.value)));
            }

            function onDateChanged(e) {
                let cin = form.date_in.value || null,
                    cout = form.date_out.value || null;
                if (cin == null || cout == null) return;

                let din = new Date(cin),
                    dout = new Date(cout);

                if (dout <= din) {
                    // check-out must be after the check-in date
                    form.date_out.value = (dout = new Date(din.getTime() + 86400000)).toISOString().substring(0, 10);
                }

                let diff = dout - din;
                let days = diff / 1000 / 60 / 60 / 24;

                Invoice.nightsReserved = days;
            }

            function onCampersChanged(e) {
                let count = Invoice.campersCount = Math.max(1, Math.min(6, e.value));
                let campers = document.getElementById('campers');

                campers.innerHTML = ""
                for (let i = 0; i < count - 1; i++) {
                    campers.innerHTML +=
                        `<div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Name</span>
                            </div>
                            <input type="text" class="form-control" placeholder="First Name" name="camper${i}_first_name" autofocus required />
                            <input type="text" class="form-control" placeholder="Last Name" name="camper${i}_last_name" required />
                        </div>`;
                }
            }

            function update() {
                let cost = 0;

                document.getElementById('day_count').innerHTML =
                    `This reservation will be for ${Invoice.nightsReserved} night${Invoice.nightsReserved > 1 ? 's' : ''}.`;

                let campingType = form.campingType.value;
                cost = campingTypes[campingType];

                cost *= Invoice.nightsReserved;
                if (campingType == 1) cost += 30; // flat fee

                total.innerText = "$" + cost;
            }

        </script>
    @endsection
</x-app>
