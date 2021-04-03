<x-dashboard.app>
    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar />

        <div class="m-5 lead">
            <p>All changes made can immediately affect the <a href="{{ route('gallery') }}">Gallery</a> page. Any modifications cannot be un-done.</p>
        </div>

        <x-errors></x-errors>
        <div class="row gap-5 g-0">
            <div class="col-sm col-md-3">
                <form method="POST" name="form" action="{{ route('dashboard.gallery.upload') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="upload" class="form-label">Upload a picture</label>
                        <input class="form-control" type="file" name="upload[]" accept="image/*" multiple>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <form method="POST" name="form" action="{{ route('dashboard.gallery.delete') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <select name="delete[]" class="form-select" size="5" aria-label="size 5 multiple select" multiple>
                        @foreach ($pictures as $picture)
                            <option value="{{ $picture->id }}">{{ $picture->name }}</option>
                        @endforeach
                    </select>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary">Delete</button>
                        <small class="text-center">Will only delete selected pictures</small>
                    </div>
                </form>
            </div>
            <div class="col-12">
                @foreach ($pictures as $picture)
                    <x-dashboard.picture id="{{ $picture->id }}" name="{{ $picture->name }}"></x-dashboard.picture>
                @endforeach
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
        </script>
    @endsection
</x-dashboard.app>
