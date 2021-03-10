<x-app-dashboard>
    <p>Here is a list of all customer reservations that currently in-progress, or is soon to come.</p>

    {{ $reservations->links('vendor.pagination.bootstrap-4') }}

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Check-In</th>
                <th scope="col">Check-Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <x-dashboard.reservation :data="$reservation">
                </x-dashboard.reservation>
            @endforeach
        </tbody>
    </table>
</x-app-dashboard>
