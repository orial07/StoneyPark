<tr style="position: relative;">
    <th><a href="{{ route('dashboard.reservation', ['id' => $reservation->id]) }}" class="stretched-link">{{ $reservation->id }}</a></th>
    <td>{{ $reservation->first_name }} {{$reservation->last_name }}</td>
    <td>{{ $reservation->email }}</td>
    <td>{{ $reservation->phone }}</td>
    <td>{{ date('Y-m-d', strtotime($reservation->date_in)) }}</td>
    <td>{{ date('Y-m-d', strtotime($reservation->date_out)) }}</td>
</tr>