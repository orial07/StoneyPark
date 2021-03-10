<tr style="position: relative;">
    <th><a href="{{ route('dashboard.reservation', ['id' => $data->id]) }}" class="stretched-link">{{ $data->id }}</a></th>
    <td>{{ $data->first_name }} {{$data->last_name }}</td>
    <td>{{ $data->email }}</td>
    <td>{{ $data->phone }}</td>
    <td>{{ $data->date_in }}</td>
    <td>{{ $data->date_out }}</td>
</tr>