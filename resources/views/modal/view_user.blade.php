{{-- <form class="forms-sample" action="" target="">
    <div class="modal-body p-5">
        <div class="form-group">
            <label for="">NIK</label>
            <input type="text" class="form-control" id="" placeholder="NIK" required="" disabled=""
                value="{{ $user->nik }}">
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" id="" placeholder="Name" required="" disabled=""
                value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="">Divisi</label>
            <input type="text" class="form-control" id="" placeholder="Divisi" required="" disabled=""
                value="{{ $user->division }}">
        </div>
        <div class="form-group">
            <label for="">Company</label>
            <input type="text" class="form-control" id="" placeholder="Company" required=""
                disabled="" value="{{ $user->company }}">
        </div>
        <div class="form-group">
            <label for="">Roles</label>=
            <input type="text" class="form-control" id="" placeholder="Company" required=""
                disabled="" value="{{ ucfirst($user->getRoleNames()[0]) }}">
        </div>
    </div>
</form> --}}

<div class="ml-2">
    <h1>{{ $user->name }}</h1>
    <h5>{{ ucfirst($user->getRoleNames()[0]) }}</h5>
</div>
<div class="table-responsive">
    <table class="table table-borderless table-light">
        <tbody>
            <tr>
                <th class="fit">NIK</th>
                <td>{{ $user->nik }}</td>
            </tr>
            <tr>
                <th>Company</th>
                <td>{{ $user->company }}</td>
            </tr>
            <tr>
                <th>Division</th>
                <td>{{ $user->division }}</td>
            </tr>
        </tbody>
    </table>

</div>
