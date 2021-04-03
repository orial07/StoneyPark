<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @for ($i = 0; $i < sizeof($carousel); $i++)
            @if ($i == 0) <button class="active"
            aria-current="true" type="button" data-bs-target="#heroCarousel"
            data-bs-slide-to="{{ $i }}" aria-label="Slide
            {{ $i }}"></button>
        @else
            <button type="button" data-bs-target="#heroCarousel"
            data-bs-slide-to="{{ $i }}" aria-label="Slide
            {{ $i }}"></button> @endif
        @endfor
    </div>
    <div class="carousel-inner">
        @for ($i = 0; $i < sizeof($carousel); $i++)
            <x-carousel-item :item="$carousel[$i]" :active="$i == 0 ? 'active' : ''"></x-carousel-item>
        @endfor
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> <!-- carousel end -->
