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
        @php
            $reason = '';
            if ($issue->status == 'progress') {
                $reason = $issue->progressIssue->progress_reason;
            } elseif ($issue->status == 'close') {
                $reason = $issue->progressIssue->closed_reason;
            } elseif ($issue->status == 'reject') {
                $reason = $issue->progressIssue->rejected_reason;
            }
        @endphp
        <h1>Your issue
            {{ $issue->status == 'progress' ? 'is beeing progressed' : 'has been ' . issue()[$issue->status] }}</h1>
        <p>Hello {{ $issue->summary->inspection->user->name }},</p> <br>
        <p>Your issue with code <b>{{ $issue->code }}</b> in daily inspection
            <b>{{ $issue->summary->inspection->code }}</b>
            {{ $issue->status == 'progress' ? 'is beeing progressed' : 'has been ' . issue()[$issue->status] }}
            by {{ $issue->userUpdate->name }} on date {{ tanggalText($issue->updated_at) }}, with reason
            {{ $reason }}
        </p>
        <p>Click the following link to see more detailed data.</p>
        <a href="{{ url('/detail-issue/' . $issue->id) }} " class="button">View Issue</a>

        <p>Thank you,</p>

        <p style="text-align: center">
            <img src="{{ url('/assets/images/logo/email-logo.png') }}" height="100" alt="Optimals logo"><br>Optimals by
            MandiriCoal
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
