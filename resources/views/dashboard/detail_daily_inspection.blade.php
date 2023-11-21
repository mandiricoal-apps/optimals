@extends('layout')
@section('daily_inspection', 'active')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-0">
                        <div class="pl-2 mb-0">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card stretch-card mb-3">
                                        <center>
                                            <div class="card-body flex-wrap pb-2 mb-4">
                                                <div>
                                                    <h5 class="font-weight-semibold mb-1 text-black">SCORE TOTAL <h1
                                                            class="text-success font-weight-bold">
                                                            {{ $dailyInspection->total_score }}</h1>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="card-body flex-wrap mb-0">
                                                <div>
                                                    <button class="btn btn-success" data-toggle="modal"
                                                        data-target="#score-modal"><i style="font-size: 14px;"
                                                            class="mdi mdi-pencil-circle-outline"></i> Edit Point</button>
                                                    <button class="btn btn-primary" onclick="approve()"><i
                                                            style="font-size: 14px;" class="mdi mdi-check"></i>
                                                        Approve</button>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-3">
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
                                <div class="col-5">
                                    <img src="{{ asset('storage/location_photo/' . $dailyInspection->location->image) }}"
                                        alt="">
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
                                <th width="50%">Question & Answer</th>
                                <th>Issue</th>
                                <th width="5%">Score Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dailyInspection->summary as $summary)
                                <tr>
                                    <td style="white-space: normal; overflow: hidden;">
                                        {{ $summary->question->question }} <br><br>
                                        <small>{{ $summary->answer->answer }}</small>
                                    </td>
                                    <td>
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

                            <form class="forms-sample" action="" target="">
                                <div class="modal-body p-5">
                                    <div class="form-group">
                                        <label for="">Point</label><span style="color:red;">*</span>
                                        <input type="number" class="form-control" id="" placeholder="160"
                                            required="">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-light form-control" data-dismiss="modal"
                                                aria-label="Close"><i style="font-size: 14px;"
                                                    class="mdi mdi-close-circle-outline"></i> Cancel</button>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary mr-2 form-control"
                                                onclick="successalert()"><i style="font-size: 14px;"
                                                    class="mdi mdi-content-save"></i> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit-->
                <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" action="" target="">
                                <div class="modal-body p-5">
                                    <div class="form-group">
                                        <label for="">Answer</label><span style="color:red;">*</span>
                                        <input type="text" class="form-control" id="" placeholder="Answer"
                                            required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Point</label><span style="color:red;">*</span>
                                        <input type="tnumberxt" class="form-control" id="" placeholder="Point"
                                            required="">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-light form-control" data-dismiss="modal"
                                                aria-label="Close"><i style="font-size: 14px;"
                                                    class="mdi mdi-close-circle-outline"></i> Cancel</button>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary mr-2 form-control"
                                                onclick="successalert()"><i style="font-size: 14px;"
                                                    class="mdi mdi-content-save"></i> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal VView-->
                <div class="modal fade" id="view-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" action="" target="">
                                <div class="modal-body p-5">
                                    <div class="form-group">
                                        <label for="">NIK</label>
                                        <input type="text" class="form-control" id="" placeholder="NIK"
                                            required="" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Name"
                                            required="" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Divisi</label>
                                        <input type="text" class="form-control" id="" placeholder="Divisi"
                                            required="" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Company</label>
                                        <input type="text" class="form-control" id="" placeholder="Company"
                                            required="" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Roles</label>=
                                        <input type="text" class="form-control" id="" placeholder="Company"
                                            required="" disabled="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active/Inactive -->
    <script type="text/javascript">
        function approve() {
            Swal.fire({
                title: 'Approve?',
                text: 'Do you want to Approve?',
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
