<x-app>
    @section('title', 'Rules')

    <x-container>
        <p class="lead p-5">Below are rules that apply to everyone at Stoney Campgrounds. We ask that you abide these
            rules.</p>

        <div class="list-group">
            @foreach ($rules as $rule)
                <div class="mt-5">
                    <h5 class="fs-4 mb-1 fw-bold">{!! $rule->title !!}</h5>
                    <p>{!! $rule->description !!}</p>
                </div>
            @endforeach
        </div>
    </x-container>
</x-app>