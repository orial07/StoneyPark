<x-app>
    <div class="container mt-4">
        <div class="text-center">
            <h1 class="text-uppercase m-0">RESERVED!</h1>
            <h3 class="text-muted">Your reservation number is #{!! $reservation->id !!}</h3>
            <p>
                We look forward to having you at our campground, make sure to save the date in your calendar.<br />
                In a few moments you'll receive an email showing your reservation. Don't delete it!<br />
            </p>
            <p class="lead">The reservation will be saved for
                <u>{{ $reservation->first_name . ' ' . $reservation->last_name }}</u>
            </p>

            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <p class="d-block">Your stay is {{ $reservation->getNights() }}
                        night{{ $reservation->getNights() > 1 ? 's' : '' }} long
                        with {{ $reservation->campers_count }}
                        {{ $reservation->campers_count == 1 ? 'person' : 'people' }}.</p>
                    <div class="tl">
                        @for ($i = 0; $i < $reservation->getNights() + 1; $i++)
                            <div class="tl-item">
                                {{ date('M j', strtotime($reservation->date_in) + $i * 86400) }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div> <!-- timeline visual -->

            <p>
                If you changed your mind, would like you cancel or have any questions, please <a
                    href="{{ route('contact') }}">contact</a> us as soon as possible!<br />
                Didn't receive the email? <a href="{{ url()->current() }}">Try sending another</a>
                @if ($email_wait)
                    <br/>Sorry if you haven't received the email! Have you checked your spam folder? Please wait {{ $email_wait }} minute{{ $email_wait != 1 ? 's' : ''}} before trying again.
                @endif
            </p>
        </div>
    </div>
</x-app>
