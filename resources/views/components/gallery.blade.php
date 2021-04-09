@if (sizeof($pictures) == 0)
    @if (!$admin)
        <x-container>
            <div class="row justify-content-center">
                <div class="col-8">
                    <p>We currently don't have any pictures of our campground to show you. Instead, take a look at our
                        content on various platforms. You can find more behind the scenes and content created by us and
                        many others!</p>
                </div>
            </div>
        </x-container>
    @endif
@else
    <div class="gallery">
        @foreach ($pictures as $picture)
            <figure class="position-relative">
                <img role="button" class="figure-img gallery-img img-thumbnail" src="{!! asset('storage/' . $picture->name) !!}" />
                @if ($admin)
                    <figcaption class="position-absolute top-0 text-light bg-dark px-3">{!! $picture->name !!}
                    </figcaption>
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
