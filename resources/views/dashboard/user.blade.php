@extends('layout')
@section('md-user', 'active')
@section('all-user', 'active')
@section('coll-md-user', 'show')
@section('css')
<style>
    td.fit,
    th.fit {
        white-space: nowrap;
        width: 1%;
    }
</style>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col">
                <i class="mdi mdi-filter-variant"></i> Filter by :
                <a href="/user?status=active" onclick="showLoader()"
                class="btn btn-{{ $status == 'active' ? 'info' : 'secondary' }}">Active</a>
                <a href="/user?status=inactive" onclick="showLoader();"
                class="btn btn-{{ $status == 'inactive' ? 'info' : 'secondary' }}">Inactive</a>
            </div>
            @can('create_user')
            <div class="col text-end mb-3">
                <button class="btn btn-primary" onclick="modalAdd()">
                    <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                </button>
            </div>
            @endcan
        </div>
        <table id="example1" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th width="">Status</th>
                    <th width="">Name</th>
                    <th width="">Divisi</th>
                    <th width="">Company</th>
                    <th width="">Roles</th>
                    <th class="text-center" width="25%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $u)
                <tr>
                    <td class="ps-5">
                        <div class="form-check form-switch">
                            @if ($u->deleted_at)
                            <div class="form-check form-switch">
                                @can('delete_user')
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                onclick="activate({{ $u->id }}, this)">
                                @endcan
                                <b><i><label class="form-check-label ms-0"
                                    for="flexSwitchCheckChecked">Inactive</label></i></b>
                                </div>
                                @else
                                @can('delete_user')
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked
                                onclick="inactive({{ $u->id }}, this)">
                                @endcan
                                <b><i><label class="form-check-label ms-0"
                                    for="flexSwitchCheckChecked">Active</label></i></b>
                                    @endif
                                </div>
                            </td>
                            <td><a href="javascript:void(0)" onclick="modalUser({{ $u->id }})">{{ $u->name }} <i
                                style="font-size: 14px;" class="mdi mdi-link-variant"></i></a>
                                <br><small class="mt-1">NIK : {{ $u->nik }}</small>
                            </td>
                            <td>{{ $u->division }}</td>
                            <td>{{ $u->company }}</td>
                            <td>{{ ucfirst($u->getRoleNames()[0]) }}</td>
                            <td class="text-center">
                                @if (!$u->deleted_at)
                                @can('edit_user')
                                <div class="button-group">
                                    <button class="btn btn-success" onclick="modalEdit({{ $u->id }})">
                                        <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                    </button>
                                    <button class="btn btn-warning" onclick="reset()">
                                      Reset Password
                                  </button>
                              </div>
                              @endcan
                              @endif
                          </td>
                      </tr>
                      @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Divisi</th>
                        <th>Company</th>
                        <th>Roles</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Modal Add-->
            <div class="modal fade" id="modal-user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-user-title" id="exampleModalLabel">Add User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modal-user-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script type="text/javascript">
        function inactive(id, button) {
            Swal.fire({
                title: 'Inactive?',
                text: 'Do you want to Inactivate User?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader()
                    window.location.href = '/inactive-user/' + id;
                } else {
                    $(button).prop('checked', true);
                }
            });
        };

        function activate(id, button) {
            Swal.fire({
                title: 'Activate?',
                text: 'Do you want to Activate User?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader()
                    window.location.href = '/active-user/' + id;
                } else {
                    $(button).prop('checked', false);

                }
            });
        };

        function successalert() {
            Swal.fire({
                icon: 'success',
                title: ' has been saved',
                showConfirmButton: false,
                timer: 1500
            });
        };

        function modalAdd() {
            $('#modal-user').modal();

            $.ajax({
                type: "get",
                url: "/modal-add-user",

                beforeSend: function() {
                    html = `<div class="text-center"> <div class="spinner-border text-primary " role="status">
                    <span class="sr-only">Loading...</span>
                    </div></div>`;
                    $('#modal-user-body').html(html);

                },
                success: function(response) {

                    $('#modal-user-body').html(response);
                }
            });
        }

        function modalEdit(id) {
            $('#modal-user').modal();
            $('#modal-user-title').text('Edit User');
            $.ajax({
                type: "get",
                url: "/modal-edit-user/" + id,

                beforeSend: function() {
                    html = `<div class="text-center"> <div class="spinner-border text-primary " role="status">
                    <span class="sr-only">Loading...</span>
                    </div></div>`;
                    $('#modal-user-body').html(html);

                },
                success: function(response) {
                    $('#modal-user-body').html(response);
                }
            });
        }
    </script>

    <script type="text/javascript">
        function reset() {
            Swal.fire({
                title: 'Reset Password?',
                text: 'Do you want to Reset Password?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {

                if (result.isConfirmed) {
                    showLoader();
                    window.location.href = '#'
                }

            });
        };
    </script>

    @stop
    @endsection
