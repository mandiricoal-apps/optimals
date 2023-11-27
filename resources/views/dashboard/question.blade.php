@extends('layout')
@section('qna', 'active')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col">
                    <i class="mdi mdi-filter-variant"></i> Filter by :
                    <a href="/question/{{ $area_id }}" onclick="showLoader();"
                        class="btn btn-{{ $status == 'active' ? 'info' : 'secondary' }}">Active</a>
                    <a href="/question/{{ $area_id }}?status=inactive" onclick="showLoader();"
                        class="btn btn-{{ $status == 'inactive' ? 'info' : 'secondary' }}">Inactive</a>
                </div>
                <div class="col text-end mb-3">
                    @can('create_qna')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-modal">
                            <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                        </button>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">

                <table id="example1" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Numbering</th>
                            <th>Code</th>
                            <th>Question</th>
                            <th>Weight</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($question->sortBy('numbering') as $q)
                            <tr>
                                <td class="ps-5">
                                    @if (!$q->deleted_at)
                                        <div class="form-check form-switch">
                                            @can('delete_qna')
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                    checked onclick="inactive({{ $q->id }},this)">
                                            @endcan
                                            <b><i><label class="form-check-label ms-0"
                                                        for="flexSwitchCheckChecked">Active</label></i></b>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            @can('delete_qna')
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                    onclick="activate({{ $q->id }}, this)">
                                            @endcan
                                            <b><i><label class="form-check-label ms-0"
                                                        for="flexSwitchCheckChecked">Inactive</label></i></b>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">{{ $q->numbering ?? '-' }}</td>
                                <td>{{ $q->code }}</td>
                                <td style="white-space: pre-line;">{{ $q->question }}</td>
                                <td>{{ $q->weight }}</td>
                                <td class="text-center">
                                    <div class="button-group">
                                        <a href="/answer/{{ $q->id }}" onclick="showLoader()"
                                            class="btn btn-warning">
                                            <i style="font-size: 14px;" class="mdi mdi-playlist-check"></i> Answer
                                        </a>
                                        @can('edit_qna')
                                            @if (!$q->deleted_at)
                                                <button class="btn btn-success" data-toggle="modal"
                                                    data-target="#edit-modal{{ $q->id }}">
                                                    <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                                </button>
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit-->
                            <div class="modal fade" id="edit-modal{{ $q->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample" action="/edit-question/{{ $q->id }}"
                                            onsubmit="showLoader();" method="POST" target="">
                                            @csrf
                                            <div class="modal-body p-5">
                                                <div class="form-group">
                                                    <label for="">Question</label><span style="color:red;">*</span>
                                                    <textarea type="text" class="form-control" id="question" name="question" placeholder="Question" required="">{{ $q->question }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Weight</label><span style="color:red;">*</span>
                                                    <input type="number" class="form-control" id="weight" name="weight"
                                                        placeholder="Weight" required="" value="{{ $q->weight }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Numbering</label><span style="color:red;">*</span>
                                                    <input type="number" class="form-control" id="numbering"
                                                        name="numbering" placeholder="Numbering" required=""
                                                        value="{{ $q->numbering }}">
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
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Numbering</th>
                            <th>Code</th>
                            <th>Question</th>
                            <th>Weight</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Modal Add-->
            <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form class="forms-sample" action="/create-question" onsubmit="showLoader();" method="POST"
                            target="">
                            @csrf
                            <div class="modal-body p-5">
                                <div class="form-group">
                                    <label for="">Question</label><span style="color:red;">*</span>
                                    <textarea type="text" class="form-control" id="question" name="question" placeholder="Question"
                                        required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Weight</label><span style="color:red;">*</span>
                                    <input type="number" class="form-control" id="weight" name="weight"
                                        placeholder="Weight" required="">
                                </div>

                                <input type="hidden" name="area_id" value="{{ $area_id }}">
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
    </div>

@section('js')
    <script>
        function inactive(id, button) {
            Swal.fire({
                title: 'Inactive?',
                text: 'Do you want to Inactivate Question?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.href = '/inactive-question/' + id;
                } else {
                    $(button).prop('checked', true);
                }
            });
        };

        function activate(id, button) {
            Swal.fire({
                title: 'Activate?',
                text: 'Do you want to Activate Question?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.href = '/active-question/' + id;
                } else {
                    $(button).prop('checked', false);

                }
            });
        };
    </script>
@stop

@endsection
