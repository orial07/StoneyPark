<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Item</th>
            <th scope="col">Qty.</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">Nights reserved</td>
            <td>{{ $reservation->getNights() }}</td>
            <td>${{ $reservation->getNights() * number_format($reservation->getType()->price, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <td scope="row">{{ $reservation->getType()->name }}</td>
            <td>{{ $reservation->getType()->quantity }}</td>
            <td>${{ $reservation->getType()->price2 }}</td>
        </tr>
        <tr class="fw-bold">
            <td scope="row">GST</td>
            <td></td>
            <td>${{ number_format($reservation->getCost(false) * 0.05, 2, '.', ',') }}</td>
        </tr>
        <tr class="fw-bold">
            <td scope="row">Total</td>
            <td></td>
            <td>${{ number_format($reservation->getCost(), 2, '.', ',') }}</td>
        </tr>
    </tbody>
</table>
