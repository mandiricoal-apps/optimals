@extends('email.layout_email')
@section('body')
    <h1>DAILY INSPECTION - {{ $dailyInspection->code }} HAS NEW ISSUE</h1>
    <p>Hello {{ $dailyInspection->user->name }},</p>
    <p>Your Daily Inspection <b>{{ $dailyInspection->code }}</b> has one or many issues, with the following details,
    <ol>
        @foreach ($issues as $issue)
            <li>
                <b>{{ $issue->code }}</b>, {{ $issue->issue }}
            </li>
        @endforeach
    </ol>
    </p>
    <p>Click the following link to see more detailed data.</p>
    <a href="{{ url('/daily-inspection-detail/' . $dailyInspection->id) }} " class="button">View Inspection</a>
@endsection
