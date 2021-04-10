<x-app>
    @section('title', '- My Account')

    <div class="container mt-4">
        <div class="m-5">
            <h1 class="text-center display-6 m-5">Welcome back, {{ auth()->user()->name }}!</h1>
            <p>Here is a list of all your reservations at Stoney Campgrounds. Should you have any questions, feel
                free to <a href="{{ route('contact') }}">contact us</a>.</p>
        </div>

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
    </div>
</x-app>
