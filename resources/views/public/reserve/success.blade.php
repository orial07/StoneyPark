<x-app>
    <div class="container mt-4">
        <div class="text-center">
            <h1 class="text-uppercase m-0">RESERVED</h1>
            <small class="text-uppercase">YAY IT WORKED!</small>
            <p>We look forward to having you at our campground, make sure to save the date in your calendar.</p>
            <p class="lead">The reservation will be saved under
                <u>{{ $customer['first_name'] . ' ' . $customer['last_name'] }}</u>
            </p>

            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <small class="d-block">Your stay is {{ $nights }} night{{ $nights > 1 ? 's' : '' }} long
                        with {{ sizeof($members) }} {{ sizeof($members) == 1 ? 'person' : 'people' }}.</small>
                    <div class="tl">
                        @for ($i = 0; $i < $nights + 1; $i++)
                            <div class="tl-item">{{ date('F j', $date_in + $i * 86400) }}</div>
                        @endfor
                    </div>
                </div>
            </div> <!-- timeline visual -->

            <p>In a few moments you'll receive and email showing this reservation.</p>
            <p>If you changed your mind and would like you cancel, please <a href="{{ route('contact') }}">contact</a> us as soon as possible!</p>
        </div>
    </div>
</x-app>
