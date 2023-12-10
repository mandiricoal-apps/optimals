@extends('layout')
@section('daily_inspection', 'active')
@section('content')
    <div class="row">

        <div class="card">
            <div class="card-body">
                <div class="row mb-1 d-flex justify-content-between">
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="col-lg-auto col-md-12 p-1">
                                <i class="mdi mdi-filter-variant"></i> Filter by :
                            </div>
                            <div class="col-lg-3 col-md-12 p-1">
                                <a class="py-3 form-control btn btn-{{ $status == 'not-approved' ? 'info' : 'secondary' }}"
                                    href="/daily-inspection-area/{{ $area_id }}?status=not-approved">Not Approved</a>
                            </div>
                            <div class="col-lg-3 col-md-12 p-1">
                                <a class="py-3 form-control btn btn-{{ $status == 'approved' ? 'info' : 'secondary' }}"
                                    href="/daily-inspection-area/{{ $area_id }}?status=approved">Approved</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="row pl-2 pt-1 pr-0">
                            <x-filter_data
                                url="{{ $status == 'not-approved' ? '/daily-inspection-area/' . $area_id . '?status=not-approved' : '/daily-inspection-area/' . $area_id . '?status=approved' }}" />
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table id="daily" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Creation Date</th>
                                <th>Daily Inspection</th>
                                <th>Score</th>
                                <th>Submitter</th>
                                <th>Submitter Name</th>
                                <th>Submitter NIK</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daily_inspections as $di)
                                <tr>
                                    <td>
                                        {!! tanggalTable($di->created_at) !!}
                                    </td>
                                    <td>
                                        {{ $di->code }}
                                        @if ($di->issue > 0)
                                            <i style="font-size: 14px;color:#ff5730;" class="mdi mdi-alert-circle-outline"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ $di->issue }} issue"></i>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $di->total_score }}
                                    </td>
                                    <td>
                                        <a href="#" onclick="modalUser({{ $di->user_id }})">{{ $di->name }} <i
                                                style="font-size: 14px;" class="mdi mdi-link-variant"></i>
                                        </a>
                                        <br><small class="mt-1">NIK : {{ $di->nik }}</small>
                                    </td>
                                    <td>
                                        {{ $di->name }}
                                    </td>
                                    <td>
                                        {{ $di->nik }}
                                    </td>
                                    <td>{{ $di->comp }}</td>
                                    <td>


                                        @if ($di->approved_at)
                                            <b><i>Approved</i></b>
                                        @else
                                            <b><i>{{ tanggal2bulandepan($di->created_at) ? 'Approved by System' : 'Not Approved' }}</i></b>
                                        @endif


                                    </td>
                                    <td class="text-center">
                                        <div class="button-group">
                                            <a href="/daily-inspection-detail/{{ $di->id }}" onclick="showLoader()"
                                                class="btn btn-warning">
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
                            <th>Daily Inspection</th>
                            <th>Score</th>
                            <th>Submitter</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot> -->
                </table>

            </div>
        </div>

        <script type="text/javascript">
            function toggleSwitchClicked() {
                Swal.fire({
                    title: 'Reload Page?',
                    text: 'Do you want to reload the page?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    location.reload();
                });
            };
        </script>
    @endsection
