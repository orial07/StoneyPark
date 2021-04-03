<x-app>
    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar></x-dashboard.navbar>

        <div class="m-5">
            <p class="lead"></p>
            <p></p>
        </div>

        <x-errors></x-errors>

        <form method="POST" action="{{ route('admin.rules.save') }}">
            @csrf

            <input type="hidden" name="id" value="{{ isset($rule) ? $rule->id : 0 }}" />

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" @if (isset($rule)) value="{!! $rule->title !!}" @endif
                    autocomplete="off" />
                <label for="title">Title</label>
            </div>
            <textarea name="description" id="editor">
                @if (isset($rule)) {!! $rule->description !!} @endif
            </textarea>

            <div class="d-flex justify-content-between my-3">
                <div class="d-block">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                @if (isset($rule))
                    <div class="d-block text-end">
                        <a href="{{ url('/admin/rules/delete/' . $rule->id) }}" class="btn btn-danger">Delete</a>
                        <small class="d-block text-muted w-100">Deleting is permanent and cannot be un-done.</small>
                    </div>
                @endif
            </div>
        </form>
    </div>

    @section('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endsection
</x-app>
