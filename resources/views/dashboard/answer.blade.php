@extends('layout')
@section('qna', 'active')

@section('content')
    <div class="card">
        <div class="card-body">


            <div class="row">
                <div class="col-10 mb-0">
                    <div class="pl-2 mb-0">
                        <span class="font-12 text-muted">Question : </span>
                        <p class="m-0 text-black"> {{ $question->question }}</p>
                        <span class="font-12 text-muted">Area : </span>
                        <p class="m-0 text-black"> {{ $question->area->area_name }}</p>
                        <span class="font-12 text-muted">Weight : </span>
                        <p class="m-0 text-black"> {{ $question->weight }}</p>
                    </div>
                </div>
                <div class="col-2 text-end mb-2">
                    @can('create_qna')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-modal">
                            <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                        </button>
                    @endcan
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="" class="table table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th width="50%">Answer</th>
                            <th width="20%">Point</th>
                            <th width="20%">Score Point</th>
                            <th width="10%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($question->answer as $answer)
                            <tr>
                                <td style="white-space: pre-line;">
                                    <p> {{ $answer->answer }} </p>
                                </td>
                                <td>{{ $answer->point }} Point</td>
                                <td>{{ $answer->point * $question->weight }}</td>
                                <td class="text-center">
                                    @can('edit_qna')
                                        <div class="button-group">
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#edit-modal{{ $answer->id }}">
                                                <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                            </button>
                                        </div>
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
                                                <div class="modal-body p-5">
                                                    <div class="form-group">
                                                        <label for="">Answer</label><span style="color:red;">*</span>
                                                        <textarea type="text" class="form-control" id="answer" name="answer" placeholder="Answer" rows="6"
                                                            required="">{{ $answer->answer }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Point</label><span style="color:red;">*</span>
                                                        <input type="number" class="form-control" id="point" name="point"
                                                            placeholder="Point" value="{{ $answer->point }}" required="">
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
    @endsection
