@if (sizeof($pictures) == 0)
    <p>Uh Oh. We don't have any pictures of our campground to show you.</p>
@else
    <div class="gallery">
        @foreach ($pictures as $picture)
            <figure class="position-relative">
                <img role="button" class="figure-img gallery-img" src="{!! asset('storage/' . $picture->name) !!}" />
                @if ($names)
                    <figcaption class="position-absolute top-0 text-light bg-dark px-3">{!! $picture->name !!}</figcaption>
                @endif
            </figure>
        @endforeach
    </div>
@endif

<div class="modal" tabindex="-1" id="gallery-modal">
    <div class="shadow modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <img class="image-fluid" id="gallery-modal-img" />
        </div>
    </div>
</div>
