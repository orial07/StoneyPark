<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <style>
        * {
            box-sizing: border-box;
        }

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
            margin-top: 1.3rem;
            padding: 1rem;
        }

        .group .title {
            padding: 1rem 0;
        }

        .fw-bold {
            font-weight: 700 !important;
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
            <h2 class="title">Reservation <span class="text-muted">(number #{!! $reservation->id !!})</span></h2>
            <p>Please remember the dates <em>arrival</em> is when you visit campgrounds and <em>departure</em>
                is when you leave (the morning of that day).</p>

            <div class="inline">
                <p class="text-left text-muted">Transaction ID</p>
                <p class="text-left">{{ $reservation->transaction_id }}</p>
            </div>

            <div class="inline">
                <p class="text-left text-muted">Arrival</p>
                <p class="text-left"><?= date('m-d-Y (F j, Y)', strtotime($reservation->date_in)) ?></p>
            </div>
            <div class="inline">
                <p class="text-left text-muted">Departure</p>
                <p class="text-left"><?= date('m-d-Y (F j, Y)', strtotime($reservation->date_out)) ?></p>
            </div>

            <x-reservation.receipt :reservation="$reservation"></x-reservation.receipt>
    </section>
    <hr/>
    <section class="group">
        <h2 class="title">Customer</h2>
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
    <hr/>
    <section class="group">
        <h2 class="title">Campers</h2>
        <x-reservation.campers :campers="$reservation->campers"></x-reservation.campers>
    </section>
</main>
</body>
</html>
