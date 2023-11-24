@extends('layout')

@section('issue', 'active')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col">
                        <i class="mdi mdi-filter-variant"></i> Filter by :
                        <a href="/issue?status=open" class="btn btn-{{ $status == 'open' ? 'info' : 'secondary' }}">Open</a>
                        <a href="/issue?status=progress"
                            class="btn btn-{{ $status == 'progress' ? 'info' : 'secondary' }}">Progress</a>
                        <a href="/issue?status=close"
                            class="btn btn-{{ $status == 'close' ? 'info' : 'secondary' }}">Close</a>
                        <a href="/issue?status=reject"
                            class="btn btn-{{ $status == 'reject' ? 'info' : 'secondary' }}">Cancle</a>
                    </div>

                </div>
                <table id="example" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Creation Date</th>
                            <th>Issue Code</th>
                            <th>Daily Inspection</th>
                            <th>Submitter</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($issues as $issue)
                            <tr>
                                <td>{{ date('d M Y', strtotime($issue->created_at)) }} <br>
                                    <b>{{ date('H:i', strtotime($issue->created_at)) }}</b>
                                </td>
                                <td>{{ $issue->issue_code }}</td>
                                <td><a href="/daily-inspection-detail/{{ $issue->inspections_id }}"
                                        target="_blank">{{ $issue->inspection_code }}
                                        <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
                                    <br><small class="mt-1">Area : {{ $issue->area_name }}</small>
                                </td>
                                <td><a href="#" onclick="modalUser({{ $issue->user_id }})" data-toggle="modal"
                                        data-target="#view-modal">{{ $issue->name }} <i style="font-size: 14px;"
                                            class="mdi mdi-link-variant"></i></a>
                                    <br><small class="mt-1">NIK : {{ $issue->nik }}</small>
                                </td>
                                <td><b><i>{{ ucfirst($issue->status == 'reject' ? 'Cancle' : $issue->status) }}</i></b>
                                </td>
                                <td class="text-center">
                                    <div class="button-group">
                                        <a href="/detail-issue/{{ $issue->issue_id }}" class="btn btn-warning">
                                            <i style="font-size: 14px;" class="mdi mdi-eye-circle-outline"></i> Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Daily Inspection</th>
                            <th>Submitter</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>




            </div>
        </div>
    </div>


@endsection
