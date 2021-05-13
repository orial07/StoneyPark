<x-app>
    @section('title', 'Reserve')

    @section('head')
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <x-errors></x-errors>

        <form id="reserve-form" method="POST" action="{{ route('reserve.submit') }}">
            @csrf

            <h2 class="my-5 text-center">Where would you like to camp?</h2>
            <div class="row justify-content-center">
                <div class="col col-md-7">
                    <div class="alert alert-info" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Due to restrictions, campsites may only have up to 5 people. Some options may be
                        disabled.
                    </div>
                </div>
                <div class="w-100"></div>

                <div class="col col-md-5">
                    <p>Selected dates include the date you arrive and depart. You can arrive on <span class="fw-bold" id="date-in">the
                            first selected date</span> and leave on the morning of <span class="fw-bold" id="date-out">the second seleced
                            date</span>.</p>
                    <x-controls.input id="dates" type="text" required>
                        <span for="dates" id="nights"></span>
                    </x-controls.input>

                    <fieldset>
                        <div class="row g-1">
                            @foreach (config('camps.types') as $ct)
                            <div class="col-12 bg-white border position-relative @if ($ct['disabled']) text-secondary @endif">
                                <input class="form-check-input" type="radio" name="camp-type" id="camp-type-{{ $loop->index }}" value="{{ $loop->index }}" @if ($loop->first) checked @endif @if ($ct['disabled']) disabled @endif>
                                    @if ($ct['disabled']) <span class="badge bg-danger">Disabled</span> @endif
                                    
                                    <div class="text-center p-4">
                                        <h1><span id="camp-type-price-{{ $loop->index }}">{!! $ct['price'] + $ct['price2'] !!}</span><small class="fs-6">+GST</small></h1>

                                        <label role="button" class="stretched-link fs-4 d-block @if($ct['disabled']) pe-disabled @endif" for="camp-type-{{ $loop->index }}">{!! $ct['name'] !!}</label>

                                        <small>${!! $ct['price'] !!}/night @if ($ct['price2'])
                                                +${!! $ct['price2'] !!} initial fee @endif</small>

                                        <hr>
                                        <ul class="list-unstyled">
                                            @foreach ($ct['descriptor'] as $type => $description)
                                                <li>
                                                    <x-svg-icon :icon="$type">{!! $description !!}</x-svg-icon>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
                <div class="col-3 g-0 user-select-none d-flex position-relative">
                    <input type="text" class="d-none" id="cg-campsite-value" name="cg-campsite-value" required readonly autocomplete="off" />
                    <div id="cg-campsite-list" class="position-absolute w-100 h-100 overflow-auto text-wrap">
                        <button type="button" id="cg-campsite-refresh" class="btn btn-success w-100">Refresh</button>
                    </div>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <h2 class="text-center mb-5">Who is reserving?</h2>

                    <div class="row">
                        <div class="col">
                            <x-controls.input id="user-name-first" type="text" placeholder="First Name" required autocomplete>First Name</x-controls.input>
                        </div>
                        <div class="col">
                            <x-controls.input id="user-name-last" type="text" placeholder="Last Name" required autocomplete>Last Name</x-controls.input>
                        </div>
                    </div>

                    <x-controls.input id="user-email" type="email" placeholder="To send your confirmation" required autocomplete>Email Address</x-controls.input>

                    <x-controls.input id="user-phone" type="tel" placeholder="To contact you" required autocomplete>Phone Number</x-controls.input>

                    <x-controls.input id="user-age" type="number" value="18" min="18" required>Age</x-controls.input>

                    <x-controls.input id="campers-count" type="number" value="1" min="1" required>
                        Number of Campers <small class="form-text text-muted w-100">(including yourself)</small>
                    </x-controls.input>
                    <div id="campers-container"></div>
                </div>
                <div class="w-100"></div>
                <div class="col-sm-12 col-md-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"><span id="invoice-nights-qty"></span>x Reserved</td>
                                <td class="text-end" id="invoice-nights-price"></td>
                            </tr>
                            <tr>
                                <td scope="row"><span id="invoice-camp-type"></span></td>
                                <td class="text-end" id="invoice-camp-price"></td>
                            </tr>
                            <tr class="fw-bold">
                                <td scope="row">GST</td>
                                <td class="text-end" id="invoice-tax-gst"></td>
                            </tr>
                            <tr class="fw-bold">
                                <td scope="row">Total</td>
                                <td class="text-end" id="invoice-total"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-grid">
                        <button class="btn btn-success" type="button" onclick="this.form.submit()">Continue To Payment</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @section('scripts')
        <script>
            Stoney.Camps = {!! json_encode(config('camps.types')) !!};

        </script>
        <script src="{{ asset('js/checkout.js') }}"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @endsection
</x-app>
