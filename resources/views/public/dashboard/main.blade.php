<x-dashboard.app>
    <div class="container mt-4">
        <x-dashboard.navbar />

        <div class="text-center">
            <h1 class="display-4">Welcome back, {{ Auth::user()->name }}</h1>
            <p>
                Welcome to the dashboard!<br />
                <small>It's still under development.</small>
            </p>
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
                    <x-dashboard.reservation :reservation="$reservation">
                    </x-dashboard.reservation>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard.app>
