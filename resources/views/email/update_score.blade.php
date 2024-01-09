@extends('email.layout_email')

@section('body')
    <h1>DAILY INSPECTION - {{ $dailyInspection->code }} SCORE HAS BEEN CHANGED</h1>
    <p>Hello {{ $dailyInspection->user->name }},</p> <br>

    <p>
        Your Score on Daily Inspection has been changed, with reason {{ $dailyInspection->reason_score }}. <br>
        The current score is <b>{{ $dailyInspection->total_score }}</b>.
    </p>
    <p>Click the following link to see more detailed data.</p>
    <a href="{{ url('/daily-inspection-detail/' . $dailyInspection->id) }} " class="button">View Inspection</a>
@endsection
