<x-admin.app>
    <x-errors></x-errors>

    @foreach ($rules as $rule)
        <div class="mt-5">
            <h5 class="fs-4 mb-1 fw-bold">
                <a href="{{ url('/admin/rules/edit/' . $rule->id) }}"><img class="svg-icon"
                        src="{{ asset('img/pencil.svg') }}" /></a>
                {!! $rule->title !!}
            </h5>
            <p>{!! $rule->description !!}</p>
        </div>
    @endforeach

    <div class="d-grid">
        <a class="btn btn-outline-dark" href="{{ route('admin.rules.create') }}">New Rule</a>
    </div>
</x-admin.app>
