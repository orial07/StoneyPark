<x-admin.app>
    <x-errors></x-errors>

    @foreach ($rules as $rule)
        <div class="mt-5">
            <a href="{{ url('/admin/rules/edit/' . $rule->id) }}">
                <x-svg-icon :icon="'pencil'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this rule"></x-svg-icon>
                <h5 class="d-inline fw-bold">{!! $rule->title !!}</h5>
            </a>
            <p>{!! $rule->description !!}</p>
        </div>
    @endforeach

    <div class="d-grid">
        <a class="btn btn-outline-dark" href="{{ route('admin.rules.create') }}">New Rule</a>
    </div>
</x-admin.app>
