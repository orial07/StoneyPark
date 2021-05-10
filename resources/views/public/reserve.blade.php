<x-app>
    @section('title', 'Reserve')

    @section('head')
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <div class="text-center my-5">
            We ask that you make reservations only with family members or close contacts living in the same home as you.<br>
            By reserving, you also agree to abide by <a href="https://www.alberta.ca/enhanced-public-health-measures.aspx" target="_blank">Alberta's
                COVID Regulations</a> and our <a href="{{ route('rules') }}" target="_blank">rules &amp; policies</a>.
        </div>

        <x-errors></x-errors>

        <form id="reserve-form" method="POST" action="reserve">
            @csrf

            <h2 class="my-5 text-center">Where would you like to camp?</h2>
            <div class="row">
                <div class="col-9 col-md-10">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <div class="carousel slide" id="cg-carousel" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active"><img src="https://dummyimage.com/1"></div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#cg-carousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#cg-carousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <dl class="row">
                                <dt class="col-4">Amenities</dt>
                                <dd class="col-8">
                                    <x-svg-icon :icon="'fire'">Firepit</x-svg-icon>
                                    <x-svg-icon :icon="'table'">Picnic Table</x-svg-icon>
                                </dd>
                            </dl>
                            <p>
                                Selected dates include the date you arrive and depart. You can arrive on <span class="fw-bold" id="date-in">the
                                    first selected date</span> and leave on the morning of <span class="fw-bold" id="date-out">the second seleced
                                    date</span>.</p>
                            <x-controls.input id="dates" type="text" required>
                                <span for="dates" id="nights"></span>
                            </x-controls.input>

                            <fieldset>
                                <div class="row g-1">
                                    @foreach (ReservationUtil::getCampingTypes() as $ct)
                                        <div class="col-12 bg-white border position-relative">
                                            <input class="form-check-input" type="radio" name="camp-type" id="camp-type-{{ $loop->index }}"
                                                value="{{ $loop->index }}" @if ($loop->first) checked @endif>

                                            <div class="text-center p-4">
                                                <h1><span id="camp-type-price-{{ $loop->index }}">{!! $ct->price + $ct->price2 !!}</span><small
                                                        class="fs-6">+GST</small></h1>
                                                <label role="button" class="stretched-link fs-4"
                                                    for="camp-type-{{ $loop->index }}">{!! $ct->name !!}</label>
                                                <small>${!! $ct->price !!}/night @if ($ct->price2)
                                                        +${!! $ct->price2 !!} initial fee @endif</small>
                                                <hr>
                                                <ul class="list-unstyled">
                                                    @foreach ($ct->description as $type => $description)
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
                    </div>
                </div>
                <div class="col g-0 user-select-none d-flex position-relative">
                    <input type="text" class="d-none" id="cg-campsite-value" name="cg-campsite-value" required readonly autocomplete="off" />
                    <div id="cg-campsite-list" class="position-absolute w-100 h-100 overflow-auto text-wrap">
                    </div>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <h2 class="text-center mb-5">Who is reserving?</h2>

                    <div class="row">
                        <div class="col">
                            <x-controls.input id="user-name-first" type="text" placeholder="First Name" required autocomplete>
                                {{ __('First Name') }}
                            </x-controls.input>
                        </div>

                        <div class="col">
                            <x-controls.input id="user-name-last" type="text" placeholder="Last Name" required autocomplete>
                                {{ __('Last Name') }}
                            </x-controls.input>
                        </div>
                    </div>

                    <x-controls.input id="user-email" type="email" placeholder="To send your confirmation" required autocomplete>
                        {{ __('Email Address') }}
                    </x-controls.input>

                    <x-controls.input id="user-phone" type="tel" placeholder="To contact you" required autocomplete>
                        {{ __('Phone Number') }}
                    </x-controls.input>

                    <x-controls.input id="user-age" type="number" value="18" min="18" required>
                        {{ __('Age') }}
                    </x-controls.input>

                    <x-controls.input id="campers-count" type="number" value="1" min="1" max="6" required>
                        {{ __('Number of Campers') }}<small class="form-text text-muted w-100"> (including yourself)</small>
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
            const CAMPING_TYPES = {!! json_encode(ReservationUtil::getCampingTypes()) !!};

        </script>
        <script src="{{ asset('js/checkout.js') }}"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @endsection
</x-app>
