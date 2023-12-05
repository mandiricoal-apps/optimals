@extends('layout')
@section('issue', 'active')
@section('css')
    <style>
        #img-location {
            object-fit: cover;
            max-height: 250px;
            width: auto;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
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
                            <div class="row">
                                <div class="col-2">
                                    <span class="font-12 text-muted">ID Daily Inspection : </span>
                                    <p class="m-0 text-black">{{ $issue->summary->inspection->code }}</p>
                                    <span class="font-12 text-muted">Creation Date : </span>
                                    <p class="m-0 text-black">
                                        {{ tanggalText($issue->summary->inspection->created_at) }} </p>
                                    <span class="font-12 text-muted">Area : </span>
                                    <p class="m-0 text-black"> {{ $issue->summary->inspection->area->area_name }}</p>
                                    <span class="font-12 text-muted">Submitter : </span>
                                    <p class="m-0 text-black"> <a href="#"
                                            onclick="modalUser({{ $issue->summary->inspection->create_by }})"
                                            data-toggle="modal"
                                            data-target="#view-modal">{{ $issue->summary->inspection->user->name }} <i
                                                style="font-size: 14px;" class="mdi mdi-link-variant"></i></a></p>
                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <div class="col">

                                            <span
                                                class="badge badge-{{ $color }}">{{ ucfirst($issue->status == 'reject' ? 'Canceled' : $issue->status) }}
                                            </span>

                                        </div>
                                    </div>
                                    <table id="" class="table table-striped table-hover mb-5" width="100%">
                                        <tbody>
                                            <tr>
                                                <th width="">Question<br><br>
                                                    <small>{{ $issue->summary->question->question }}</small>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="" style="white-space: normal">Answer<br><br>
                                                    <small>{{ $issue->summary->answer->answer }}</small>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="">Issue<br><br>
                                                    <small>
                                                        {{ $issue->issue }}
                                                    </small>
                                                    <hr>
                                                    @if ($issue->image == null)
                                                        <div class="col-12 text-center ">
                                                            <h2 class="text-black-50"><span
                                                                    class="mdi mdi-image-area"></span> NO
                                                                ATTACHMENT
                                                            </h2>
                                                        </div>
                                                    @else
                                                        @if (is_array(json_decode($issue->image)))
                                                            <div class="row">
                                                                @foreach (json_decode($issue->image) as $item)
                                                                    <div class="col-2 my-auto">
                                                                        <img src="{{ asset('storage/issue_photo/' . $item) }}"
                                                                            class="img-fluid" id="img-location"
                                                                            alt="{{ $item }}" data-toggle="modal"
                                                                            data-target="#img-modal{{ $loop->iteration }}"
                                                                            style="width: 120px;height: 120px;">
                                                                    </div>


                                                                    <div class="modal fade"
                                                                        id="img-modal{{ $loop->iteration }}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-md modal-dialog-centered"
                                                                            role="document" style="width: fit-content">
                                                                            <div class="modal-content">
                                                                                <img src="{{ asset('storage/issue_photo/' . $item) }}"
                                                                                    style="width: 100%;height: 100%;border-radius: 0;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <!--  <img src="https://akcdn.detik.net.id/visual/2016/11/07/1773d313-6717-43e3-87d6-c8bc5effcc5d_169.jpg" style=" border-radius:5px;">&emsp;
                                                                                            <img src="https://akcdn.detik.net.id/visual/2016/11/07/1773d313-6717-43e3-87d6-c8bc5effcc5d_169.jpg" style=" border-radius:5px;">&emsp;
                                                                                            <img src="https://akcdn.detik.net.id/visual/2016/11/07/1773d313-6717-43e3-87d6-c8bc5effcc5d_169.jpg" style=" border-radius:5px;">&emsp;
                                                                                            <img src="https://akcdn.detik.net.id/visual/2016/11/07/1773d313-6717-43e3-87d6-c8bc5effcc5d_169.jpg" style=" border-radius:5px;">&emsp; -->
                                                </th>
                                            </tr>
                                            <tr>
                                                <td style="white-space: normal">
                                                    @can('edit_issue')
                                                        @if ($issue->status == 'open' || $issue->status == 'progress')
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <select class="form-select form-select" id="select-status">
                                                                        {{-- <option value="open"
                                                            {{ $issue->status == 'open' ? 'selected' : '' }}
                                                            disabled>Open
                                                        </option> --}}
                                                                        @can('progress_issue')
                                                                            @if ($issue->status != 'progress')
                                                                                <option
                                                                                    {{ $issue->status == 'progress' ? 'selected' : '' }}
                                                                                    value="progress">On Progress</option>
                                                                            @endif
                                                                        @endcan
                                                                        @can('close_issue')
                                                                            <option
                                                                                {{ $issue->status == 'close' ? 'selected' : '' }}
                                                                                value="close">Closed</option>
                                                                        @endcan
                                                                        @can('cancle_issue')
                                                                            <option
                                                                                {{ $issue->status == 'reject' ? 'selected' : '' }}
                                                                                value="reject">Cancelled</option>
                                                                        @endcan
                                                                    </select>
                                                                </div>
                                                                <div class="col-3">
                                                                    <button class="btn btn-primary" onclick="changeStatus()"><i
                                                                            style="font-size: 14px;" class="mdi mdi-save"></i>
                                                                        Change Status</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endcan
                                                    @if ($issue->status != 'open')
                                                        <ul>
                                                            @if ($issue->progressIssue->rejected_at != null)
                                                                <li>Issue has been <b>Canceled</b> by
                                                                    {{ $issue->progressIssue->userRejected->name }} at
                                                                    {{ tanggalText($issue->progressIssue->rejected_at) }}
                                                                    <br>
                                                                    with reason:
                                                                    {!! nl2br($issue->progressIssue->rejected_reason) !!}.
                                                                </li>
                                                            @endif
                                                            @if ($issue->progressIssue->progress_at != null)
                                                                <li class="mt-3">Issue is being <b>progressed </b> by
                                                                    {{ $issue->progressIssue->userProgress->name }} start
                                                                    at
                                                                    {{ tanggalText($issue->progressIssue->progress_at) }}
                                                                    <br>
                                                                    with reason:
                                                                    {!! nl2br($issue->progressIssue->progress_reason) !!}.
                                                                </li>
                                                            @endif
                                                            @if ($issue->progressIssue->closed_at != null)
                                                                <li class="mt-3">Issue has been <b>Closed </b> by
                                                                    {{ $issue->progressIssue->userClosed->name }} at
                                                                    {{ tanggalText($issue->progressIssue->closed_at) }}
                                                                    <br>
                                                                    with reason:
                                                                    {!! nl2br($issue->progressIssue->closed_reason) !!}.
                                                                </li>
                                                                @if ($issue->progressIssue->closed_file)
                                                                    <a href="{{ asset('storage/attach_file/' . $issue->progressIssue->closed_file) }}"
                                                                        target="_blank">Attachment
                                                                        <i style="font-size: 14px;"
                                                                            class="mdi mdi-link-variant"></i></a>
                                                                @else
                                                                    <p>No Attachment</p>
                                                                @endif
                                                            @endif


                                                        </ul>

                                                    @endif
                                                </td>
                                            </tr>
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

    {{-- Progress Modal --}}
    <div class="modal fade" id="progress-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Status to On Progress</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="post" action="/change-status-issue/{{ $issue->id }}"
                    onsubmit="showLoader()" target="">
                    <div class="modal-body ">
                        @csrf
                        <input type="hidden" name="status" value="progress">
                        <p>Are you sure to <b>On Progress</b> this issue ?</p>
                        <div class="mb-3">
                            <p>Please give reason <b class="text-danger">*</b></p>
                            <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Reason" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-light form-control" data-dismiss="modal" aria-label="Close"><i
                                        style="font-size: 14px;" class="mdi mdi-close-circle-outline"></i> Cancel</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary mr-2 form-control"><i
                                        style="font-size: 14px;" class="mdi mdi-content-save"></i> Yes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Close Modal --}}
    <div class="modal fade" id="close-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Status to Closed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="forms-sample" method="post" action="/change-status-issue/{{ $issue->id }}"
                    onsubmit="showLoader()" target="" enctype="multipart/form-data">
                    <div class="modal-body ">
                        @csrf
                        <input type="hidden" name="status" value="close">
                        <p>Are you sure to <b>Closed</b> this issue ?</p>
                        <div class="mb-3">
                            <p>Please give reason <b class="text-danger">*</b></p>
                            <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Reason" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="form-label">Attachment <b class="text-danger">*</b></label>
                            <input type="file" name="closed_file" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-light form-control" data-dismiss="modal" aria-label="Close"><i
                                        style="font-size: 14px;" class="mdi mdi-close-circle-outline"></i> Cancel</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary mr-2 form-control"><i
                                        style="font-size: 14px;" class="mdi mdi-content-save"></i> Yes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Reject Modal --}}
    <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Status to Cancelled</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="post" action="/change-status-issue/{{ $issue->id }}"
                    onsubmit="showLoader()" target="">
                    <div class="modal-body ">
                        @csrf
                        <input type="hidden" name="status" value="reject">
                        <p>Are you sure to <b>Reject</b> this issue ?</p>
                        <div class="mb-3">
                            <p>Please give reason <b class="text-danger">*</b></p>
                            <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Reason" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-light form-control" data-dismiss="modal" aria-label="Close"><i
                                        style="font-size: 14px;" class="mdi mdi-close-circle-outline"></i> Cancel</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary mr-2 form-control"><i
                                        style="font-size: 14px;" class="mdi mdi-content-save"></i> Yes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('js')
    <script>
        function changeStatus() {
            let val = $('#select-status').val();
            if (val == 'progress') {
                $('#progress-modal').modal('show');
            } else if (val == 'close') {
                $('#close-modal').modal('show');
            } else if (val == 'reject') {
                $('#reject-modal').modal('show');
            }
        }
    </script>
@stop

@endsection
