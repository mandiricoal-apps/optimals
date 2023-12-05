@extends('layout')

@section('area', 'active')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mb-0">
                    <i class="mdi mdi-filter-variant"></i> Filter by :
                    <a href="/area?status=active" onclick="showLoader()"
                        class="btn btn-{{ $status == 'active' ? 'info' : 'secondary' }}">Active</a>
                    <a href="/area?status=inactive" onclick="showLoader()"
                        class="btn btn-{{ $status == 'inactive' ? 'info' : 'secondary' }}">Inactive</a>
                </div>
                <div class="col text-end mb-3">
                    @can('create_area')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-modal">
                            <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                        </button>
                    @endcan
                </div>
            </div>
            <table id="example1" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Area Name</th>
                        <th>Area Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($area as $a)
                        <tr>
                            <td class="ps-5">
                                <div class="form-check form-switch">
                                    @if ($a->deleted_at)
                                        <div class="form-check form-switch">
                                            @can('delete_area')
                                                <input class="form-check-input" type="checkbox" id=""
                                                    onclick="activate({{ $a->id }}, this)">
                                            @endcan
                                            <b>
                                                <i>
                                                    <label class="form-check-label ms-0"for="">Inactive</label>
                                                </i>
                                            </b>
                                        </div>
                                    @else
                                        @can('delete_area')
                                            <input class="form-check-input" type="checkbox" id=""
                                                onclick="inactive({{ $a->id }}, this)" checked>
                                        @endcan
                                        <b>
                                            <i>
                                                <label class="form-check-label ms-0" for="">Active</label>
                                            </i>
                                        </b>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <b>{{ $a->area_code }}</b><br>
                                {{ $a->area_name }}
                            </td>
                            <td>{{ $a->description }}</td>
                            <td class="text-center">
                                @if (!$a->deleted_at)
                                    @can('edit_area')
                                        <div class="button-group">
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#edit-modal{{ $a->id }}">
                                                <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                            </button>
                                        </div>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                        <!-- Modal Edit-->
                        <div class="modal fade" id="edit-modal{{ $a->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="forms-sample" action="/edit-area/{{ $a->id }}"
                                        onsubmit="showLoader()" method="post" target="">
                                        @csrf
                                        <div class="modal-body p-5">
                                            <div class="form-group">
                                                <label for="">Area Name</label><span style="color:red;">*</span>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Area Name" required="" disabled=""
                                                    value="{{ $a->area_name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Area Description</label><span
                                                    style="color:red;">*</span>
                                                <textarea type="text" class="form-control" id="description" name="description" placeholder="Area Description"
                                                    required="" rows="3">{{ $a->description }}</textarea>
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
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Status</th>
                        <th>Area Name</th>
                        <th>Area Description</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Modal Add-->
            <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form class="forms-sample" action="/create-area" onsubmit="showLoader();" target=""
                            method="post">
                            @csrf
                            <div class="modal-body p-5">
                                <div class="form-group">
                                    <label for="">Area Name</label><span style="color:red;">*</span>
                                    <input type="text" class="form-control" id="area_name" name="area_name"
                                        placeholder="Area Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Area Description</label><span style="color:red;">*</span>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Area Description"
                                        required="" rows="3"></textarea>
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
    </div>

@section('js')
    <script>
        function inactive(id, button) {
            Swal.fire({
                title: 'Inactive?',
                text: 'Do you want to Inactivate Area?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.href = '/inactive-area/' + id;
                } else {
                    $(button).prop('checked', true);
                }
            });
        };

        function activate(id, button) {
            Swal.fire({
                title: 'Activate?',
                text: 'Do you want to Activate Area?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    window.location.href = '/active-area/' + id;
                } else {
                    $(button).prop('checked', false);

                }
            });
        };
    </script>
@stop
@endsection
