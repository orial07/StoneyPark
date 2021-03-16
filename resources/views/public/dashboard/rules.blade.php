<x-dashboard.app>
    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar />

        <form method="POST" name="form" action="{{ route('dashboard.rules.submit') }}">
            @csrf

            <ul class="list-group list-group-flush" id="rules">
                @for ($i = 0; $i < sizeof($rules); $i++)
                    <x-rule-dashboard id="{{ $i }}" title="{{ $rules[$i]->title }}">
                        {{ $rules[$i]->description }}
                    </x-rule-dashboard>
                @endfor

                <x-rule-dashboard id="new"></x-rule-dashboard>
            </ul>

            <div class="text-center">
                <button type="button" class="btn btn-primary mt-4" onclick="createRule()">Add Rule</button>
                <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
            </div>
        </form>
    </div>

    @section('scripts')
        <script>
            const template = `<x-rule-dashboard id="new"/>`;
            var ruleCount = parseInt("{{ sizeof($rules) }}");

            $(document).ready(function() {
                document.form.addEventListener('change', function(e) {
                    updateRule(e.target);
                });
            });

            function updateRule(e) {
                let id = e.name.split("_");
                if (!id || !(id = id[id.length - 1])) return;

                let title = document.getElementById(`title_${id}`);
                let description = document.getElementById(`description_${id}`);

                if (id == 'new') {
                    title.name = title.id = `title_${ruleCount}`;
                    title.attributes['value'] = title.value;
                    description.name = description.id = `description_${ruleCount}`;

                    ruleCount++;
                }
            }

            function createRule() {
                $('#rules').append(template);
            }

        </script>
    @endsection
</x-dashboard.app>
