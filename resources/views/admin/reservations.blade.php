<x-admin.app>
    <h1 class="fw-bold text-center p-5">Customer Reservations</h1>

    {{ $reservations->links('vendor.pagination.bootstrap-4') }}
    <form action="{{ route('admin.reservations.search') }}" method="POST" role="search" autocomplete="off">
        @csrf

        <x-controls.input id="search" type="text" required>
            <x-slot name="prepend">
                <button type="button" class="btn btn-outline-secondary">a</button>
            </x-slot>

            {{ __('Search') }}
        </x-controls.input>
    </form>

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
                <tr class="position-relative">
                    <th><a href="{{ route('reservation', ['id' => $reservation->id]) }}"
                            class="stretched-link">{{ $reservation->id }}</a></th>
                    <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td>{{ date('F j, Y', strtotime($reservation->date_in)) }}</td>
                    <td>{{ date('F j, Y', strtotime($reservation->date_out)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin.app>
