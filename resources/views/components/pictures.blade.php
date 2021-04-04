@if (sizeof($pictures) == 0)
    <p>Uh Oh. We don't have any pictures of our campground to show you.</p>
@else
    <ul class="list-unstyled d-flex gallery">
        @foreach ($pictures as $picture)
            <li>
                <img role="button" class="figure-img gallery-img img-thumbnail rounded" src="{!! asset('storage/' . $picture->name) !!}" />
                @if ($names)
                    <p class="figure-caption">{!! $picture->name !!}</p>
                @endif
            </li>
        @endforeach
    </ul>
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
