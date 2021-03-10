<x-app>
    <div class="container mt-4">
        <p class="lead">
            We love our park, so we want the best for it.<br />
            Please read the following Yes and No rules and abide by them when on campgrounds.
        </p>

        <div class="list-group">
            @for ($i = 0; $i < sizeof($rules); $i++)
                <x-rule title="{{ $rules[$i]->title }}">
                    {{ $rules[$i]->description }}
                </x-rule>
            @endfor
        </div>
    </div>
</x-app>
