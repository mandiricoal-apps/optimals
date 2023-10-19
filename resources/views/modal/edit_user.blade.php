<link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
<link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />

<form class="forms-sample" action="/edit-user/{{ $user->id }}" onsubmit="showLoader();" method="POST">
    @csrf
    <div class="modal-body p-5">
        <div class="form-group">
            <label for="">Company</label><span style="color:red;">*</span>
            <input class="form-control" id="company" name="" value="{{ $user->company }}" readonly required>

        </div>

        <div class="form-group">
            <label for="">NIK</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" required=""
                value="{{ $user->nik }}" readonly>
        </div>
        <div class="form-group">
            <label for="">Name</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required=""
                value="{{ $user->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="">Divisi</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="division" name="division" placeholder="Divisi"
                value="{{ $user->division }}" required="" readonly>
        </div>

        <div class="form-group">
            <label for="">Roles</label><span style="color:red;">*</span>
            <select name="roles" id="roles" class="" style="width: 100%;" required>

                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id == $user->roles->first()->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <button class="btn btn-light form-control" data-dismiss="modal" aria-label="Close"><i
                        style="font-size: 14px;" class="mdi mdi-close-circle-outline"></i> Cancel</button>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mr-2 form-control"><i style="font-size: 14px;"
                        class="mdi mdi-content-save"></i> Save </button>
            </div>
        </div>
    </div>
</form>

<script src="assets/vendors/select2/select2.min.js"></script>
<script>
    var select2_roles = $('#roles').select2({
        theme: 'bootstrap'
    });

    var field = ['name', 'nik', 'division'];

    function clearField() {
        field.forEach(f => {
            $('#' + f).val('');
        });
    }
</script>
