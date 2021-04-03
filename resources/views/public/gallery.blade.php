<x-app>
    @section('title', '- Gallery')

    <div class="container mt-4">
        <div class="row">
            @if (sizeof($pictures) > 0)
                <div class="col-12">
                    @foreach ($pictures as $picture)
                        <x-picture name="{{ $picture->name }}"></x-picture>
                    @endforeach
                </div>
            @else
                <div class="m-5 lead text-center">
                    <p>Uh Oh. We don't have any pictures of our campground to show you.</p>
                </div>
            @endif
        </div>
    </div>
</x-app>
