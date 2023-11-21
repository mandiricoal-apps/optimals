@extends('layout')
@section('daily_inspection', 'active')
@section('content')
    <div class="row">

        <div class="card">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col">
                        <i class="mdi mdi-filter-variant"></i> Filter by :
                        <a class="btn btn-{{ $status == 'not-approved' ? 'info' : 'secondary' }}"
                            href="/daily-inspection-area/{{ $area_id }}?status=not-approved">Not
                            Approved</a>
                        <a class="btn btn-{{ $status == 'approved' ? 'info' : 'secondary' }}"
                            href="/daily-inspection-area/{{ $area_id }}?status=approved">Approved</a>
                    </div>

                </div>
                <table id="example" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Creation Date</th>
                            <th>Daily Inspection</th>
                            <th>Submitter</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daily_inspections as $di)
                            <tr>
                                <td>{{ date('d M Y', strtotime($di->created_at)) }} <br>
                                    <b>
                                        {{ date('H:i', strtotime($di->created_at)) }}
                                    </b>
                                </td>
                                <td>
                                    {{ $di->code }} <i style="font-size: 14px;color:#ff5730;"
                                        class="mdi mdi-alert-circle-outline"></i>
                                    <br><small>Area : {{ $area_name }}</small>
                                </td>
                                <td>
                                    <a href="#" onclick="modalUser({{ $di->user_id }})">{{ $di->name }} <i
                                            style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
                                    <br><small class="mt-1">NIK : {{ $di->nik }}</small>
                                </td>
                                <td>
                                    <b><i>{{ $di->approved_at ? 'Approved' : 'Not Approved' }}</i></b>
                                </td>
                                <td class="text-center">
                                    <div class="button-group">
                                        <a href="/daily-inspection-detail/{{ $di->id }}" class="btn btn-warning">
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
                            <th>Daily Inspection</th>
                            <th>Submitter</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
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
