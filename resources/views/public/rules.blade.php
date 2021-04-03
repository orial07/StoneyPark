<x-app>
    <div class="container mt-4">
        <div class="lead m-5">
            <p>Below are rules that apply to everyone at Stoney Campgrounds. We ask that you abide these rules.</p>
        </div>

        <div class="list-group">
            @for ($i = 0; $i < sizeof($rules); $i++)
                <x-rule title="{{ $rules[$i]->title }}">
                    {{ $rules[$i]->description }}
                </x-rule>
            @endfor
        </div>
    </div>
</x-app>
