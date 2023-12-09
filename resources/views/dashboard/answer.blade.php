@extends('layout')
@section('qna', 'active')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-10 mb-0">
                <div class="pl-2 mb-0">
                    <h3>{{ $question->code }}</h3>
                    <span class="font-12 text-muted">Question : </span>
                    <p class="m-0 text-black"> {{ $question->question }}</p>
                    <span class="font-12 text-muted">Area : </span>
                    <p class="m-0 text-black"> {{ $question->area->area_name }}</p>
                    <span class="font-12 text-muted">Weight : </span>
                    <p class="m-0 text-black"> {{ $question->weight }}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-2 d-flex justify-content-between">
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-lg-auto col-md-12 p-1">
                        <i class="mdi mdi-filter-variant"></i> Filter by :
                    </div>
                    <div class="col-lg-3 col-md-6 p-1">
                        <a href="/answer/{{ $question->id }}" onclick="showLoader();" class="py-3 form-control btn btn-{{ $status == 'active' || $status == null ? 'info' : 'secondary' }}">Active</a>
                    </div>
                    <div class="col-lg-3 col-md-6 p-1">
                        <a href="/answer/{{ $question->id }}?status=inactive" onclick="showLoader();" class="py-3 form-control btn btn-{{ $status == 'inactive' ? 'info' : 'secondary' }}">Inactive</a>
                    </div>
                </div>
            </div>
            @can('create_qna')
            @if ($question->answer->whereNull('deleted_at')->count() < 4)
            <div class="col-lg-2 col-md-12 text-end p-1">
                <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-modal">
                    <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                </button>
            </div>
            @endif
            @endcan
        </div>

        <div class="table-responsive">
            <table id="" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="20%">Status</th>
                        <th width="10%">Code</th>
                        <th width="50%">Answer</th>
                        <th width="10%">Point</th>
                        <th width="5%">Score Point</th>
                        <th width="5%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($answers as $answer)
                    <tr>
                        <td class="ps-5">
                            @if (!$answer->deleted_at)
                            <div class="form-check form-switch">
                                @can('delete_qna')
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                checked onclick="inactive({{ $answer->id }},this)">
                                @endcan
                                <b><i><label class="form-check-label ms-0"
                                    for="flexSwitchCheckChecked">Active</label></i></b>
                                </div>
                                @else
                                <div class="form-check form-switch">
                                    @can('delete_qna')
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    onclick="activate({{ $answer->id }}, this)">
                                    @endcan
                                    <b><i><label class="form-check-label ms-0"
                                        for="flexSwitchCheckChecked">Inactive</label></i></b>
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $answer->code }}</td>
                                <td style="white-space: pre-line;">
                                    <p> {{ $answer->answer }} </p>
                                </td>
                                <td>{{ $answer->point }} Point</td>
                                <td>{{ $answer->point * $question->weight }}</td>
                                <td class="text-center">
                                    @can('edit_qna')
                                    @if (!$answer->deleted_at)
                                    <div class="button-group">
                                        <button class="btn btn-success" data-toggle="modal"
                                        data-target="#edit-modal{{ $answer->id }}">
                                        <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                    </button>
                                </div>
                                @endif
                                @endcan
                            </td>
                        </tr>
                        @can('edit_qna')
                        <!-- Modal Edit-->
                        <div class="modal fade" id="edit-modal{{ $answer->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Answer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="forms-sample" action="/edit-answer/{{ $answer->id }}"
                                        onsubmit="showLoader();" method="POST" target="">
                                        @csrf
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <div class="modal-body p-5">
                                            <div class="form-group">
                                                <label for="">Answer</label><span style="color:red;">*</span>
                                                <textarea type="text" class="form-control" id="answer" disabled placeholder="Answer" rows="6"
                                                required="">{{ $answer->answer }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Point</label><span style="color:red;">*</span>
                                                <input type="number" class="form-control" id="point"
                                                name="point" placeholder="Point" value="{{ $answer->point }}"
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
                                                    <button type="submit"
                                                    class="btn btn-primary mr-2 form-control"><i
                                                    style="font-size: 14px;" class="mdi mdi-content-save"></i>
                                                Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
                @endcan
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Modal Add-->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Answer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="forms-sample" action="/create-answer" onsubmit="showLoader();" method="POST"
            target="">
            @csrf
            <div class="modal-body p-5">
                <div class="form-group">
                    <label for="">Answer</label><span style="color:red;">*</span>
                    <textarea type="text" class="form-control" id="answer" name="answer" placeholder="Answer" rows="6"
                    required=""></textarea>
                </div>
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <div class="form-group">
                    <label for="">Point</label><span style="color:red;">*</span>
                    <input type="number" class="form-control" id="point" name="point"
                    placeholder="Point" required="">
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
                            style="font-size: 14px;" class="mdi mdi-content-save"></i> Save </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('js')
<script>
    function inactive(id, button) {
        Swal.fire({
            title: 'Inactive?',
            text: 'Do you want to Inactivate Answer?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoader();
                window.location.href = '/inactive-answer/' + id;
            } else {
                $(button).prop('checked', true);
            }
        });
    };

    function activate(id, button) {
        Swal.fire({
            title: 'Activate?',
            text: 'Do you want to Activate Answer?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoader();
                window.location.href = '/active-answer/' + id;
            } else {
                $(button).prop('checked', false);

            }
        });
    };
</script>
@stop
@endsection
