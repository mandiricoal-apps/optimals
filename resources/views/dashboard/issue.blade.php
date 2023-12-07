@extends('layout')

@section('issue', 'active')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row border mb-3 py-2">
                    <div class="col-7 my-auto">
                        <i class="mdi mdi-filter-variant"></i> Filter by :
                        <a href="/issue?status=open" class="btn btn-{{ $status == 'open' ? 'info' : 'secondary' }}">Open</a>
                        <a href="/issue?status=progress" class="btn btn-{{ $status == 'progress' ? 'info' : 'secondary' }}">On
                            Progress</a>
                        <a href="/issue?status=close"
                            class="btn btn-{{ $status == 'close' ? 'info' : 'secondary' }}">Closed</a>
                        <a href="/issue?status=reject"
                            class="btn btn-{{ $status == 'reject' ? 'info' : 'secondary' }}">Cancelled</a>
                    </div>
                    <div class="col-5">
                        <x-filter_data url="/issue?status={{ request()->get('status') }}" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="issue" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Creation Date</th>
                                <th>Issue Code</th>
                                <th>Daily Inspection</th>
                                <th>Daily Inspection ID</th>
                                <th>Daily Inspection Area</th>
                                <th>Submitter</th>
                                <th>Submitter Name</th>
                                <th>Submitter NIK</th>
                                <th>Description</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($issues as $issue)
                                <tr>
                                    <td>{!! tanggalTable($issue->created_at) !!}</td>
                                    <td>{{ $issue->issue_code }}</td>
                                    <td><a href="/daily-inspection-detail/{{ $issue->inspections_id }}"
                                            target="_blank">{{ $issue->inspection_code }}
                                            <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
                                        <br><small class="mt-1">Area : {{ $issue->area_name }}</small>
                                    </td>
                                    <td>{{ $issue->inspection_code }}</td>
                                    <td>{{ $issue->area_name }}</td>
                                    <td><a href="#" onclick="modalUser({{ $issue->user_id }})" data-toggle="modal"
                                            data-target="#view-modal">{{ $issue->name }} <i style="font-size: 14px;"
                                                class="mdi mdi-link-variant"></i></a>
                                        <br><small class="mt-1">NIK : {{ $issue->nik }}</small>
                                    </td>
                                    <td>{{ $issue->name }}</td>
                                    <td>{{ $issue->nik }}</td>
                                    <td style="white-space:pre-wrap; min-width: 300px;">{{ $issue->issue }}</td>
                                    <td>{{ strtoupper($issue->company) }}</td>
                                    {{-- <td><b><i>{{ ucfirst($issue->status == 'reject' ? 'Cancel' : $issue->status) }}</i></b>
                                    </td> --}}
                                    <td><b><i>{{ issue()[$issue->status] }}</i></b></td>
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
                                <th>Creation Date</th>
                                <th>Issue Code</th>
                                <th>Daily Inspection</th>
                                <th>Submitter</th>
                                <th>Company</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>




            </div>
        </div>
    </div>


@endsection
