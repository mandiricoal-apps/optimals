@extends('layout')

@section('issue', 'active')

@section('content')


    <div class="row">
        <div class="col-6 col-md-3 mb-md-0 mb-3">
            <a href="/issue?status=open&all=true" style="text-decoration: none">
                <div class="card shadow-sm" style="background-color:rgba(255, 166, 0, 0.2); cursor: pointer; ">
                    <div class="card-body" style="color:rgba(255, 166, 1) ">
                        Open (All)
                        <h1>{{ $open }}</h1>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-6 col-md-3 mb-md-0 mb-3">
            <a href="/issue?status=progress&all=true" style="text-decoration: none">
                <div class="card shadow-sm" style="background-color:rgba(100, 148, 237, 0.3); cursor: pointer;">
                    <div class="card-body" style="color:rgba(100, 148, 237,1) ">
                        On Progress (All)
                        <h1>{{ $progress }}</h1>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-6 col-md-3 mb-md-0 mb-3">
            <a href="/issue?status=close&all=true" style="text-decoration: none">
                <div class="card shadow-sm" style="background-color:rgba(54, 230, 130, 0.3); cursor: pointer;">
                    <div class="card-body" style="color:rgba(46, 139, 87,1)">
                        Closed (All)
                        <h1>{{ $close }}</h1>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-6 col-md-3 mb-md-0 mb-3">
            <a href="/issue?status=reject&all=true" style="text-decoration: none">
                <div class="card shadow-sm" style="background-color:rgba(220, 20, 60, 0.2); cursor: pointer;">
                    <div class="card-body" style="color:crimson ">
                        Cancelled (All)
                        <h1>{{ $reject }}</h1>
                    </div>
                </div>

            </a>

        </div>
    </div>
    <div class="d-flex my-3">
        <hr class="my-auto flex-grow-1" style="border: 1px solid rgba(0,0,0, 0.5);">
        <div class="px-4"><small class="text-dark"><i><b>*</b> Note : Total Issue adalah Summary data dari <b>Go Live</b>
                    Optimals - GMP
                    sampai Tanggal  <b>{{ date('d F Y') }}</b></i></small></div>
        {{-- <hr class="my-auto flex-grow-1" style="border: 1px solid rgba(0,0,0, 0.5);"> --}}
    </div>
    {{-- <div class="text-end my-2">
        <p><small class="text-dark"><i><b>*</b> Note : Total Issue adalah Summary data dari <b>Go Live</b> Optimals - GMP
                    sampai Tanggal  <b>{{ date('d F Y') }}</b></i></small></p>

    </div> --}}
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1 d-flex justify-content-between">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-lg-auto col-md-12 p-1">
                                <i class="mdi mdi-filter-variant"></i> Filter by :
                            </div>
                            <div class="col-lg-2 col-md-6 p-1">
                                <a href="/issue?status=open"
                                    class="py-3 form-control btn btn-{{ $status == 'open' ? 'info' : 'secondary' }}">Open</a>
                            </div>
                            <div class="col-lg-2 col-md-6 p-1">
                                <a href="/issue?status=progress"
                                    class="py-3 form-control btn btn-{{ $status == 'progress' ? 'info' : 'secondary' }}">On
                                    Progress</a>
                            </div>
                            <div class="col-lg-2 col-md-6 p-1">
                                <a href="/issue?status=close"
                                    class="py-3 form-control btn btn-{{ $status == 'close' ? 'info' : 'secondary' }}">Closed</a>
                            </div>
                            <div class="col-lg-3 col-md-6 p-1">
                                <a href="/issue?status=reject"
                                    class="py-3 form-control btn btn-{{ $status == 'reject' ? 'info' : 'secondary' }}">Cancelled</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="row pl-2 pt-1 pr-0">
                            <x-filter_data url="/issue?status={{ request()->get('status') }}" />
                        </div>
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
                                <th>Inspection Area</th>
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
                        <!-- <tfoot>
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tfoot> -->
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
