<x-app>
    <x-container class="mt-5">
        <div class="row">
            <div class="col-2">
                <x-admin.navbar></x-admin.navbar>
            </div>
            <div class="col">
                <div class="m-5 lead">
                    <p>All changes made can immediately affect the <a href="{{ route('rules') }}">Rules</a> page. Any
                        modifications cannot be un-done.</p>
                </div>

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
            </div>
    </x-container>
</x-app>