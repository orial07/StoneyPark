<x-admin.app>
    <h1 class="fw-bold text-center p-5">Customer Reservations</h1>

    <x-errors></x-errors>

    {{ $reservations->links('vendor.pagination.bootstrap-4') }}
    <form action="{{ route('admin.reservations') }}" method="POST" role="search" autocomplete="off">
        @csrf

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="search" name="search">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Check-In</th>
                <th scope="col">Check-Out</th>
                <th scole="col">Campsite</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr class="">
                <th><a href="{{ route('reservation', ['id' => $reservation->id]) }}">{{ $reservation->id }}</a></th>
                <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                <td>{{ $reservation->email }}</td>
                <td>{{ $reservation->status }}</td>
                <td>{{ date('M j, Y', strtotime($reservation->date_in)) }}</td>
                <td>{{ date('M j, Y', strtotime($reservation->date_out)) }}</td>
                <td>{{ $reservation->campground_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-admin.app>