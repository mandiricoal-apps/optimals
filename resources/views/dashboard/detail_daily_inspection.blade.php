@extends('layout')
@section('daily_inspection', 'active')

@section('css')
<style>
    #img-location:hover {
        opacity: 0.7;
    }
</style>
@stop
@section('content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mb-0">
                    <div class="pl-2 mb-0">
                        <div class="row" style="">
                            <div class="col-lg-4 col-md-12 ">
                                <div class="card stretch-card mb-3">
                                    <center>
                                        <div class="card-body flex-wrap pb-2 mb-4 px-1">
                                            <div>
                                                <h5 class="font-weight-semibold mb-1 text-black">SCORE TOTAL <h1
                                                    class="text-success font-weight-bold">
                                                    {{ round($dailyInspection->total_score, 2) }}</h1>
                                                </h5>
                                                @if ($dailyInspection->score_update_by != null)
                                                <small>
                                                    First Score :
                                                    {{ round($logScore->first()->score ?? $dailyInspection->total_score, 2) }}
                                                </small>
                                                <p class="card-text"><small class="text-muted">Score has been
                                                    Changed by
                                                    <b>{{ $dailyInspection->userUpdateScore->name }}</b> <br>
                                                    with
                                                    reason: {{ $dailyInspection->reason_score }} <br>
                                                    <a href="#" data-toggle="modal"
                                                    data-target="#log-score-modal">Score History <i
                                                    style="font-size: 14px;"
                                                    class="mdi mdi-link-variant"></i></a>
                                                </small>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body flex-wrap mb-0 px-2">
                                        @if ($dailyInspection->approved_at == null)
                                        @if (tanggal2bulandepan($dailyInspection->created_at) == false)
                                        @can('edit_daily_inspection')
                                        <div>
                                            <button class="btn btn-success" data-toggle="modal"
                                            data-target="#score-modal"><i style="font-size: 14px;"
                                            class="mdi mdi-pencil-circle-outline"></i> Update
                                        Score</button>
                                        <button class="btn btn-primary"
                                        onclick="approve({{ $dailyInspection->id }})"><i
                                        style="font-size: 14px;" class="mdi mdi-check"></i>
                                    Approve</button>
                                </div>
                                @endcan
                                @else
                                <p class="card-text"><small class="text-muted">Approved by
                                    <b>System</b> at
                                    {{ tanggalText(date('Y-m-02 23:59:59', strtotime($dailyInspection->created_at . ' +1 months'))) }}</small>
                                </p>
                                @endif
                                @else
                                <p class="card-text"><small class="text-muted">Approved by
                                    <b>{{ $dailyInspection->userapprove->name }}</b> at
                                    {{ tanggalText($dailyInspection->approved_at) }}</small>
                                </p>
                                @endif
                            </div>
                        </center>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 mb-3">
                    <span class="font-12 text-muted">ID Daily Inspection : </span>
                    <p class="m-0 text-black">{{ $dailyInspection->code }}</p>
                    <span class="font-12 text-muted">Creation Date : </span>
                    <p class="m-0 text-black">
                        {{ tanggalText($dailyInspection->created_at) }}
                    </p>
                    <span class="font-12 text-muted">Area : </span>
                    <p class="m-0 text-black"> {{ $dailyInspection->area->area_name }}</p>
                    <span class="font-12 text-muted">Submitter : </span>
                    <p class="m-0 text-black"> <a href="#"
                        onclick="modalUser({{ $dailyInspection->user->id }})">{{ $dailyInspection->user->name }}
                        <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a></p>
                    </div>
                    <div class="col-lg-5 col-md-12 mb-3">
                        <div class="card stretch-card p-4">
                            <div class="row">
                                <b>Detail Location</b>
                                <hr>
                                <div class="col-lg-4 col-md-12">
                                    <img src="{{ asset('storage/location_photo/' . $dailyInspection->location->image) }}"
                                    alt="location image" class=" " data-toggle="modal"
                                    data-target="#img-modal" id="img-location" width="120px" height="120px"
                                    style=" border-radius:5px;"><br>
                                </div>
                                <div class="col-lg-3 col-6">
                                    @foreach ($dataLocation as $key => $val)
                                    <b>
                                        <p class="m-0 text-black">{{ $key }}</p>
                                    </b>
                                    @endforeach
                                </div>
                                <div class="col-lg-5 col-6">
                                    @foreach ($dataLocation as $key => $val)
                                    <p class="m-0 text-black">: {{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table id="" class="table table-striped table-hover mb-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th width="50%">Question & Answer</th>
                    <th width="40%">Issue</th>
                    <th width="5%">Score Point</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dailyInspection->summary as $summary)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td style="white-space: normal; overflow: hidden;">
                        {{ $summary->question->question }} <br><br>
                        <small>{{ $summary->answer->answer }}</small>
                    </td>
                    <td style="white-space: normal; overflow: hidden;">
                        @if ($summary->issue)
                        <small>
                            {{ $summary->issue->issue }}<br><br>
                            <i><b>Status : {{ ucfirst($summary->issue->status) }} |
                                <a href="/detail-issue/{{ $summary->issue->id }}"
                                    target="_blank">Detail Issue <i
                                    class="mdi mdi-arrow-top-right"></i></a>
                                </b></i>
                            </small>
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $summary->score }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="score-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Point</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="forms-sample" method="post" action="/edit-score/{{ $dailyInspection->id }}"
                    onsubmit="showLoader()" target="">
                    <div class="modal-body p-5">
                        @csrf
                        <div class="form-group">
                            <label for="">Point</label><span style="color:red;">*</span>
                            <input type="number" class="form-control" id=""
                            value="{{ round($dailyInspection->total_score, 2) }}" max="100"
                            min="1" step="any" name="score" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Reason</label><span style="color:red;">*</span>
                            <textarea class="form-control" id="" name="reason_score" required="" rows="3"></textarea>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-light form-control" data-dismiss="modal"
                                aria-label="Close"><i style="font-size: 14px;"
                                class="mdi mdi-close-circle-outline"></i> Cancel</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary mr-2 form-control"><i
                                    style="font-size: 14px;" class="mdi mdi-content-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="log-score-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Score History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <th>No.</th>
                            <th>Score</th>
                            <th>Reason</th>
                            <th>Updater</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @foreach ($logScore as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->score }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ tanggalText($log->created_at) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
<<<<<<< HEAD
=======

                <div class="modal fade" id="score-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Point</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form class="forms-sample" method="post" action="/edit-score/{{ $dailyInspection->id }}"
                                onsubmit="showLoader()" target="">
                                <div class="modal-body p-5">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Point</label><span style="color:red;">*</span>
                                        <input type="number" class="form-control" id=""
                                            value="{{ round($dailyInspection->total_score, 2) }}" max="100"
                                            min="1" step="any" name="score" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Reason</label><span style="color:red;">*</span>
                                        <textarea class="form-control" id="" name="reason_score" required="" rows="3"></textarea>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-light form-control" data-dismiss="modal"
                                                aria-label="Close"><i style="font-size: 14px;"
                                                    class="mdi mdi-close-circle-outline"></i> Cancel</button>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary mr-2 form-control"><i
                                                    style="font-size: 14px;" class="mdi mdi-content-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="log-score-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Score History</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <th>No.</th>
                                            <th>Score</th>
                                            <th>Reason</th>
                                            <th>Updater</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($logScore as $log)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $log->score }}</td>
                                                    <td style="white-space:pre-line; line-break:auto">
                                                        {{ $log->description }}</td>
                                                    <td>{{ $log->user->name }}</td>
                                                    <td>{{ tanggalText($log->created_at) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal fade" id="img-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document" style="width: fit-content">
                        <div class="modal-content">
                            <img src="{{ asset('storage/location_photo/' . $dailyInspection->location->image) }}"
                                alt="location image" class="img-fluid " style="max-height: 600; object-fit: contain;">
                        </div>
                    </div>
                </div>


>>>>>>> c99fbd48ae33790db7109a8f1076360be379a78a
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="img-modal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-md modal-dialog-centered" role="document" style="width: fit-content">
    <div class="modal-content">
        <img src="{{ asset('storage/location_photo/' . $dailyInspection->location->image) }}"
        alt="location image" class="img-fluid " style="max-height: 600; object-fit: contain;">
    </div>
</div>
</div>


</div>
</div>

<!-- Active/Inactive -->
<script type="text/javascript">
    function approve(id) {
        Swal.fire({
            title: 'Approve?',
            text: 'Do you want to Approve?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoader();
                window.location.href = "/approve-daily-inspection/" + id;
            }


        });
    };
</script>
@endsection
