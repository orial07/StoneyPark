<x-admin-app>
    <p class="lead p-5">All changes made can immediately affect the <a href="{{ route('gallery') }}">Gallery</a> page.
        Any modifications cannot be un-done.</p>

    <x-errors></x-errors>

    <div class="row justify-content-center">
        <!-- upload -->
        <div class="col-sm col-md-3">
            <form method="POST" name="form" action="{{ route('admin.gallery.upload') }}"
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

        <!-- delete -->
        <div class="col-sm col-md-3">
            <form method="POST" name="form" action="{{ route('admin.gallery.delete') }}"
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

        <!-- gallery -->
        <div class="col-12">
            <x-pictures :pictures="$pictures" :names="true"></x-pictures>
        </div>
    </div>
</x-admin-app>
