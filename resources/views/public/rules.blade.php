<x-app>
    @section('title', 'Rules')

    <x-container>
        <p class="lead my-5">
            Due to current COVID-19 restrictions, spots are limited to a max of 5 people and cohorts from 2 households. We will be following <a href="https://www.alberta.ca/enhanced-public-health-measures.aspx">AHS guidelines</a> and enforcing social distancing amongst groups. Failing to comply may lead into removal of group with no refunds.
        </p>

        @foreach ($rules as $rule)
        <div class="my-4">
            <h3 class="mb-1 fw-bold">{!! $rule->title !!}</h3>
            <p>{!! $rule->description !!}</p>
        </div>
        @endforeach
    </x-container>
</x-app>