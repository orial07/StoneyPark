<x-app>
    <div class="container mt-4">
        <div class="text-center">
            <h1 class="text-uppercase m-0">RESERVED!</h1>
            <p>We look forward to having you at our campground, make sure to save the date in your calendar.</p>
            <p class="lead">The reservation will be saved for
                <u>{{ $reservation->first_name . ' ' . $reservation->last_name }}</u>
            </p>

            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <p class="d-block">Your stay is {{ $nights }} night{{ $nights > 1 ? 's' : '' }} long
                        with {{ sizeof($campers) }} {{ sizeof($campers) == 1 ? 'person' : 'people' }}.</p>
                    <div class="tl">
                        @for ($i = 0; $i < $nights + 1; $i++)
                            <div class="tl-item">
                                {{ date('M j', strtotime($reservation->date_in) + $i * 86400) }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div> <!-- timeline visual -->

            <p>In a few moments you'll receive an email showing your reservation.</p>
            <p>If you changed your mind, would like you cancel or have any questions, please <a href="{{ route('contact') }}">contact</a>
                us as soon as possible!</p>
        </div>
    </div>
</x-app>
