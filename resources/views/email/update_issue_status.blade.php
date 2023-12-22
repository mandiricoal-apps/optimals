@extends('email.layout_email')

@section('body')
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
    <a href="{{ url('/detail-issue/' . $issue->id) }} " class="button"><b>View Issue</b></a>
@endsection
