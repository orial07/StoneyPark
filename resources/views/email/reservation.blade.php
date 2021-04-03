<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <style>
        body {
            min-width: 300px;
            font-family: "Nunito", sans-serif;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        small {
            font-size: 0.875em;
        }

        table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        table tr:nth-child(2n) {
            background-color: #dddddd;
        }

        td,
        th {
            padding: 8px;
            border: 1px solid rgba(11, 11, 11, 0.2);
        }

        .container {
            max-width: 60vw;
            width: 100%;
        }

        .mx-auto {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .lead {
            font-size: 1.25em;
            font-weight: 300;
        }

        .inline {
            margin-bottom: 0.5rem;
        }

        .inline>p:first-child {
            min-width: 100px;
        }

        .inline>* {
            display: inline-block;
        }

        .group {
            border-top: 1px solid #6c757d;
            margin-top: 1.3rem;
            padding: 1rem;
        }

        .group .title {
            display: inline;
            position: relative;
            top: -25px;
            background: #fff;
            margin-bottom: 2.8rem;
            padding: 0 10px;
        }

        @media screen and (max-width: 440px) {
            .container {
                max-width: 100vw;
            }
        }

    </style>
</head>

<body>
    <main class="container mx-auto">
        <section class="group">
            <h3 class="title">Reservation</h3>
            <div class="inline">
                <p class="text-left text-muted">Check-In</p>
                <p class="text-left"><?= date('Y-m-d (l F j)', strtotime($reservation->date_in)) ?></p>
        </div>
        <div class="inline">
            <p class="text-left text-muted">Check-Out</p>
            <p class="text-left"><?= date('Y-m-d (l F j)', strtotime($reservation->date_out)) ?></p>
        </div>

        <table>
            <thead>
            <tr>
                <th>Item</th>
                <th>Qty.</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nights reserved</td>
                <td>{{ $nights }}</td>
                <td></td>
            </tr>
            <tr>
                @if ($reservation->camping_type != 2)
                    <td>Medium tent</td>
                    <td>{{ $reservation->camping_type == 0 ? 1 : 2 }}</td>
                    <td>$39</td>
        @else
                    <td>RV spot</td>
                    <td>1</td>
                    <td>$69</td>
                @endif
            </tr>
            @if ($reservation->camping_type == 1)
                <tr>
                    <td>Extra medium tent</td>
                    <td>1</td>
                    <td>$30</td>
                </tr>
            @endif
            <tr>
                <td><strong>Total</strong></td>
                <td></td>
                <td><strong>${{ $cost }}</strong></td>
            </tr>
        </tbody>
        </table>
    </section>

    <section class="group">
        <h3 class="title">Customer</h3>
        <div class="inline">
            <p class="lead">{{ $reservation->first_name }} {{ $reservation->last_name }}</p>
        </div>
        <div class="inline">
            <p class="text-left text-muted">Email</p>
            <p class="text-left">{{ $reservation->email }}</p>
        </div>
        <div class="inline">
            <p class="text-left text-muted">Phone</p>
            <p class="text-left">{{ $reservation->phone }}</p>
        </div>
        <div class="inline">
            <p class="text-left text-muted">Age</p>
            <p class="text-left">{{ $reservation->age }}</p>
        </div>
    </section>

    <section class="group">
        <h3 class="title">Campers</h3>
        @for ($i = 0; $i < sizeof($campers); $i++)
            <div class="inline">
                <p class="lead">{{ $i + 1 }}. {{ $campers[$i]->first_name }} {{ $campers[$i]->last_name }}</p>
            </div>
        @endfor
    </section>
</main>
</body>
</html>
