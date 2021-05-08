<x-app>
    @section('title', 'Rules')

    <x-container>
        <div class="list-group">
            @foreach ($rules as $rule)
                <div class="mt-3">
                    <h5 class="fs-4 mb-1 fw-bold">{!! $rule->title !!}</h5>
                    <p>{!! $rule->description !!}</p>
                </div>
            @endforeach
        </div>
    </x-container>
</x-app>