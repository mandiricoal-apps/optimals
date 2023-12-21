@extends('layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-1 d-flex justify-content-between">
                <div class="col-lg-6 col-md-12">

                </div>
                @can('create_notif_email')
                    <div class="col-lg-2 col-md-12 text-end p-1">
                        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-modal">
                            <i style="font-size: 14px;" class="mdi mdi-plus-circle-outline"></i> Add
                        </button>
                    </div>
                @endcan
            </div>
            <div class="table-responsive">

                <table id="example1" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Company</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emails as $email)
                            <tr>

                                <td>{{ $email->email }}</td>
                                <td>{{ $email->company }}</td>
                                <td class="text-center">
                                    <div class="button-group">

                                        @can('edit_notif_email')
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#edit-modal{{ $email->id }}">
                                                <i style="font-size: 14px;" class="mdi mdi-pencil-circle-outline"></i> Edit
                                            </button>
                                        @endcan
                                        @can('delete_notif_email')
                                            <button class="btn btn-danger" onclick="deleteEmail({{ $email->id }})">
                                                <i style="font-size: 14px;" class="mdi mdi-trash-can-outline"></i> Delete
                                            </button>
                                        @endcan
                                    </div>
                            </tr>
                            <!-- Modal Edit-->
                            <div class="modal fade" id="edit-modal{{ $email->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="forms-sample" action="/edit-notif-email/{{ $email->id }}"
                                            onsubmit="showLoader();" method="POST" target="">
                                            @csrf
                                            <div class="modal-body p-5">
                                                <div class="form-group">
                                                    <label for="">Email</label><span style="color:red;">*</span>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        placeholder="Email" required value="{{ $email->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Company</label><span style="color:red;">*</span>
                                                    <select class="form-select" id="company" name="company"
                                                        placeholder="Company" required>
                                                        <option value="">Select Company</option>
                                                        @foreach (company() as $comp)
                                                            <option value="{{ $comp }}"
                                                                {{ $comp == $email->company ? 'selected' : '' }}>
                                                                {{ $comp }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                    </div>
                                </div>
                            </div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form class="forms-sample" action="/create-notif-email" onsubmit="showLoader();" method="POST"
                            target="">
                            @csrf
                            <div class="modal-body p-5">
                                <div class="form-group">
                                    <label for="">Email</label><span style="color:red;">*</span>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Company</label><span style="color:red;">*</span>
                                    <select class="form-select" id="company" name="company" placeholder="company"
                                        required>
                                        <option value="">Select Company</option>
                                        @foreach (company() as $comp)
                                            <option value="{{ $comp }}">{{ $comp }}</option>
                                        @endforeach
                                    </select>
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
    <script type="text/javascript">
        function deleteEmail(id) {
            Swal.fire({
                title: 'Delete?',
                text: 'Do you want to Delete Email?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader()
                    window.location.href = '/delete-notif-email/' + id;
                }
            });
        };
    </script>
@stop

@endsection
