<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #DC3545;
            color: #fff !important;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('body')

        <p>Thank you,</p>

        <p style="text-align: center">
            <img src="{{ url('/assets/images/logo/email-logo.jpg') }}" height="100" alt="Optimals logo"><br>
            <a href="{{ url('') }} ">Optimals by MandiriCoal</a>
        </p>

        <p>
            <small>
                <i>
                    Caution: This is an automatically generated e-mail, please do not reply or send any e-mail to this
                    address. <br>
                    To ensure receipt of update from OPTIMALS-GMP, please note the following advice : <br>
                    1. Your e-mail account must be valid and active. <br>
                    2. Your mailbox has sufficient space to receive email.
                </i>
            </small>
        </p>
    </div>
</body>

</html>
