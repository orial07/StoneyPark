<div class="carousel-item {!! $active !!}" style="background-image: url({{ asset($item->image) }})">
    <div class="container">
        <div class="carousel-caption text-start">
            <h1>{{ $item->title }}</h1>
            <p>{{ $item->subtitle }}</p>
            <p><a class="btn btn-lg btn-primary" href="{{ $item->url }}">{{ $item->button }}</a></p>
        </div>
    </div>
</div>
