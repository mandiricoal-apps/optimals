@extends('layout')
@section('daily_inspection', 'active')

@section('css')
    <style>
        #img-location {
            object-fit: cover;
            height: 250px;
            width: auto;
            border-start-start-radius: 20px;
            border-end-start-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        #img-location-cover {
            border-start-start-radius: 20px;
            border-end-start-radius: 20px;
        }

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
                                <div class="col-4 ">
                                    <div class="card stretch-card mb-3">
                                        <center>
                                            <div class="card-body flex-wrap pb-2 mb-4 px-1">
                                                <div>
                                                    <h5 class="font-weight-semibold mb-1 text-black">SCORE TOTAL <h1
                                                            class="text-success font-weight-bold">
                                                            {{ $dailyInspection->total_score }}</h1>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="card-body flex-wrap mb-0 px-2">
                                                @if ($dailyInspection->approved_at == null)
                                                    @can('edit_daily_inspection')
                                                        <div>
                                                            <button class="btn btn-success" data-toggle="modal"
                                                                data-target="#score-modal"><i style="font-size: 14px;"
                                                                    class="mdi mdi-pencil-circle-outline"></i> Edit
                                                                Score</button>
                                                            <button class="btn btn-primary"
                                                                onclick="approve({{ $dailyInspection->id }})"><i
                                                                    style="font-size: 14px;" class="mdi mdi-check"></i>
                                                                Approve</button>
                                                        </div>
                                                    @endcan
                                                @else
                                                    <p class="card-text"><small class="text-muted">Approved at
                                                            {{ date('d M Y H:i', strtotime($dailyInspection->approved_at)) }}</small>
                                                    </p>
                                                @endif
                                            </div>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <span class="font-12 text-muted">ID Daily Inspection : </span>
                                    <p class="m-0 text-black">{{ $dailyInspection->code }}</p>
                                    <span class="font-12 text-muted">Creation Date : </span>
                                    <p class="m-0 text-black">
                                        {{ date('d M Y H:i', strtotime($dailyInspection->created_at)) }}
                                    </p>
                                    <span class="font-12 text-muted">Area : </span>
                                    <p class="m-0 text-black"> {{ $dailyInspection->area->area_name }}</p>
                                    <span class="font-12 text-muted">Submitter : </span>
                                    <p class="m-0 text-black"> <a href="#"
                                            onclick="modalUser({{ $dailyInspection->user->id }})">{{ $dailyInspection->user->name }}
                                            <i style="font-size: 14px;" class="mdi mdi-link-variant"></i></a></p>
                                </div>
                                <div class="col-5 text-center">
                                    <div class="card mb-4">
                                        <div class="row no-gutters">
                                            <div class="col-md-5 my-auto text-left bg-dark" id="img-location-cover">
                                                <img src="{{ asset('storage/location_photo/' . $dailyInspection->location->image) }}"
                                                    alt="location image" class="img-fluid " data-toggle="modal"
                                                    data-target="#img-modal" id="img-location">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h5 class="card-title">Data Location</h5>
                                                    <div class="text-left">
                                                        <table class="">
                                                            <tbody>
                                                                @foreach ($dataLocation as $key => $val)
                                                                    <tr>
                                                                        <td><small><b>{{ $key }}</b></small></td>
                                                                        <td class="pl-3">
                                                                            <small>{{ $val }}</small>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
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
                                                        <a href="#">Detail Issue <i
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
                                    <div class="form-group">
                                        <label for="">Point</label><span style="color:red;">*</span>
                                        @csrf
                                        <input type="number" class="form-control" id=""
                                            value="{{ $dailyInspection->total_score }}" name="score" required="">
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
