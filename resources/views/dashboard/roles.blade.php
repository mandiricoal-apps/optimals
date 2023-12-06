@extends('layout')
@section('md-user', 'active')
@section('roles', 'active')
@section('coll-md-user', 'show')


@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mb-0">
                    <!-- <i class="mdi mdi-filter-variant"></i> Filter by : -->
                </div>
                <div class="col text-end mb-3">
                    @can('create_roles')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-modal">
                            <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                        </button>
                    @endcan
                </div>
            </div>
            <table id="example1" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Roles</th>
                        <th>Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>

                            <td>{{ ucfirst($role->name) }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="text-center">
                                @can('edit_roles')
                                    <div class="button-group">
                                        <a href="/role-management/{{ $role->id }}" onclick="showLoader()" type="button"
                                            class="btn btn-warning">
                                            <i style="font-size: 14px;" class="mdi mdi-settings"></i> Manage
                                        </a>
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-target="#edit-modal{{ $role->id }}">
                                            <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                        </button>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                        <!-- Modal Edit-->
                        <div class="modal fade" id="edit-modal{{ $role->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="forms-sample" action="/edit-role/{{ $role->id }}" method="post"
                                        target="">
                                        @csrf
                                        <div class="modal-body p-5">
                                            <div class="form-group">
                                                <label for="">Role</label><span style="color:red;">*</span>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Area Name" required="" readonly
                                                    value="{{ $role->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Role Description</label><span
                                                    style="color:red;">*</span>
                                                <input type="text" class="form-control" id="description"
                                                    name="description" placeholder="Area Description" required=""
                                                    value="{{ $role->description }}">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="is_admin"
                                                    name="is_admin" value="option1" {{ $role->is_admin ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_admin">Administrator</label>
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
                        <th>Roles</th>
                        <th>Description</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form class="forms-sample" action="/create-roles" method="post" onsubmit="showLoader()"
                            target="">
                            @csrf
                            <div class="modal-body p-5">
                                <div class="form-group">
                                    <label for="">Role Name</label><span style="color:red;">*</span>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Role Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Role Description</label><span style="color:red;">*</span>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Role Description" required>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin"
                                        value="option1">
                                    <label class="form-check-label" for="is_admin">Administrator</label>
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

@stop
@endsection
