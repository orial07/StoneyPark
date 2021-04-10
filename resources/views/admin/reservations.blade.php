<x-admin-app>
    <h1 class="fw-bold text-center p-5">Customer Reservations</h1>
    <p>Here's a list of all customer reservations. Read-only data. Click any entry to view reservation, pricing and more.</p>

    {{ $reservations->links('vendor.pagination.bootstrap-4') }}

    <form action="{{ route('admin.reservations.search') }}" method="POST" role="search" autocomplete="off">
        @csrf

        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
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
                    <td>{{ date('Y-m-d', strtotime($reservation->date_in)) }}</td>
                    <td>{{ date('Y-m-d', strtotime($reservation->date_out)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin-app>