<x-app>
    <div class="container mt-4">
        <div class="row">
            @if (sizeof($pictures) > 0)
                @foreach ($pictures as $picture)
                    <div class="col-4">
                        <img src="{{ asset('storage/' . $picture->name) }}"
                            class="img-thumbnail m-2" />
                    </div>
                @endforeach
            @else
                <p class="lead text-center">
                    We don't have any pictures to show here yet.
                </p>
            @endif
        </div>
    </div>
</x-app>
