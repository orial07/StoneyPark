<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            background-color: #eaeaea;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 300;
            line-height: 1.8;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .contact-form {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: white;
            z-index: 5;
            padding: 80px 50px;
            transform: translate3d(-100%, 0, 0);
            transition: 0.3s ease;
            border-radius: 5px;
        }

        .contact-form .close {
            color: rgba(0, 0, 0, 0.7);
            position: absolute;
            right: 30px;
            top: 30px;
        }

        .cards {
            margin: auto;
            background: #fefefe;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1), 3px 5px 20px rgba(0, 0, 0, 0.2);
            width: 768px;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 30px;
        }

        .cards .card-content {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            transition: -webkit-clip-path 1s ease;
            padding: 100px 0 0;
            overflow: hidden;
            border-radius: 5px;
        }

        .cards .card-content .row {
            display: table;
            width: 100%;
            height: 100%;
        }

        .cards .card-content .col {
            width: 50%;
            height: 100%;
            display: table-cell;
            transition: 0.3s ease 0.3s;
            vertical-align: top;
        }

        .cards .card-content .col h2 {
            font-weight: 300;
            font-size: 3em;
            line-height: 1;
            margin: 0 0 30px;
        }

        .cards .card-content .col h2 strong {
            font-weight: 700;
            display: block;
        }

        .cards .card-content .col.left {
            padding-left: 50px;
        }

    </style>
</head>

<body>
    <div class="cards">
        <div class="card-content">
            <div class="row">
                <div class="left col">
                    <h2>{{ $name }} sent you mail from <strong><a
                                href="mailto:{{ $email }}">{{ $email }}</a></strong></h2>

                    <h3>Subject: {{ $subject }}</h3>
                    <p>{{ $content }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
