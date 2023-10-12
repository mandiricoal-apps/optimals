@extends('layout')
@section('md-user', 'active')
@section('roles', 'active')
@section('coll-md-user', 'show')

@section('css')
    <style>
        input.for-permission-check {
            border: 1px solid #1e5180;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-12 pr-0">
            <div class="card">
                <div class="card-body">
                    <form action="/update-permission/{{ $role->id }}" onsubmit="showLoader()" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table class="table custom-table text-dark">
                                <thead>
                                    <tr>
                                        <th>Fitur</th>
                                        <th class="text-center">Access</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Update</th>
                                        <th class="text-center">Delete</th>
                                        <!-- <th class="text-center">Approval</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parents as $parent)
                                        <tr>
                                            <td>{{ $parent->parent }}</td>
                                            @php
                                                $permission = $permissions->where('parent', '=', $parent->parent);
                                                
                                            @endphp

                                            <td class="text-center">
                                                @php
                                                    $p_view = $permission->where('type', '=', 'view')->first();
                                                @endphp
                                                @if ($p_view)
                                                    <div class="form-check">
                                                        <input class="form-check-input for-permission-check"
                                                            name="permissions[]" value="{{ $p_view->name }}" type="checkbox"
                                                            {{ $role->hasPermissionTo($p_view->name) ? 'checked' : '' }}>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $p_create = $permission->where('type', '=', 'create')->first();
                                                @endphp
                                                @if ($p_create)
                                                    <div class="form-check">
                                                        <input class="form-check-input for-permission-check"
                                                            name="permissions[]" value="{{ $p_create->name }}"
                                                            type="checkbox"
                                                            {{ $role->hasPermissionTo($p_create->name) ? 'checked' : '' }}>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $p_edit = $permission->where('type', '=', 'edit')->first();
                                                @endphp
                                                @if ($p_edit)
                                                    <div class="form-check">
                                                        <input class="form-check-input for-permission-check"
                                                            name="permissions[]" value="{{ $p_edit->name }}" type="checkbox"
                                                            {{ $role->hasPermissionTo($p_edit->name) ? 'checked' : '' }}>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $p_delete = $permission->where('type', '=', 'delete')->first();
                                                @endphp
                                                @if ($p_delete)
                                                    <div class="form-check">
                                                        <input class="form-check-input for-permission-check"
                                                            name="permissions[]" value="{{ $p_delete->name }}"
                                                            type="checkbox"
                                                            {{ $role->hasPermissionTo($p_delete->name) ? 'checked' : '' }}>
                                                    </div>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-end"><br>
                                <button type="submit" class="btn btn-success mr-2"><i style="font-size: 14px;"
                                        class="mdi mdi-content-save"></i> Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
