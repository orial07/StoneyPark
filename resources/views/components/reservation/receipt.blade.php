<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">{{ $reservation->getNights() }}x Nights Reserved</td>
            <td class="text-end">$
                {{ number_format($reservation->getNights() * $reservation->getType()['price'], 2, '.', ',') }}</td>
        </tr>
        <tr>
            <td scope="row">{{ $reservation->getType()['name'] }}</td>
            <td class="text-end">$ {{ number_format($reservation->getType()['price2'], 2, '.', ',') }}</td>
        </tr>
        <tr class="fw-bold">
            <td scope="row">GST</td>
            <td class="text-end">$ {{ number_format($reservation->getCost(false) * 0.05, 2, '.', ',') }}</td>
        </tr>
        <tr class="fw-bold">
            <td scope="row">Total</td>
            <td class="text-end">$ {{ number_format($reservation->getCost(), 2, '.', ',') }}</td>
        </tr>
    </tbody>
</table>
