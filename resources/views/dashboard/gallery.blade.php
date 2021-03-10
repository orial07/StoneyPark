<x-dashboard.app>
    <x-errors></x-errors>

    <form method="POST" name="form" action="{{ route('dashboard.gallery.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="upload" class="form-label">Upload a picture</label>
            <input class="form-control" type="file" id="upload" name="upload" multiple>
        </div>

        <div class="row">
            @foreach ($pictures as $picture)
                <div class="col-4">
                    <div class="form-group mh-100">
                        <img src="{{ asset('storage/' . $picture->name) }}" class="img-thumbnail m-2" />
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="picture-{{ $picture->id }}" name="picture-{{ $picture->id }}" value="{{ $picture->name }}" />
                            <label class="form-check-label" for="picture-{{ $picture->id }}">
                                Delete {{ $picture->name }}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Upload / Delete</button>
            <small class="d-block w-100">Will only delete selected pictures</small>
        </div>
    </form>

    @section('scripts')
        <script>
        </script>
    @endsection
</x-dashboard.app>
