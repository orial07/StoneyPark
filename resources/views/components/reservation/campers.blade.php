<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($campers as $camper)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $camper->first_name }}</td>
            <td>{{ $camper->last_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
