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
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Your issue is {{ issue()[$issue->status] }}</h1>
        <p>Hello {{ $issue->summary->inspection->user->name }},</p>
        <p>Your issue with code <b>{{ $issue->code }}</b> in daily inspection
            <b>{{ $issue->summary->inspection->code }}</b> is {{ issue()[$issue->status] }}
            at {{ tanggalText($issue->updated_at) }} by {{ $issue->userUpdate->name }}
        </p>



        <a href="{{ url('/detail-issue/' . $issue->id) }} " class="button">View Issue</a>

        <p>Optimals App</p>
    </div>
</body>

</html>
