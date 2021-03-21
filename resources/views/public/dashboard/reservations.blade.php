<x-dashboard.app>

    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar />

        <p>Here's a list of all customer reservations that are currently in-progress or soon to come.</p>

        {{ $reservations->links('vendor.pagination.bootstrap-4') }}

        <form action="{{ route('dashboard.reservations.search') }}" method="GET" role="search" autocomplete="off">
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
                    <x-dashboard.reservation :reservation="$reservation">
                    </x-dashboard.reservation>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard.app>
