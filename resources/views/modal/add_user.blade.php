<link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
<link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />

<form class="forms-sample" action="/create-user" onsubmit="showLoader();" method="POST">
    @csrf
    <div class="modal-body p-5">
        <div class="form-group">
            <label for="">Company</label><span style="color:red;">*</span>
            <select class="form-select" id="company" name="company" required>
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Select User</label><span style="color:red;">*</span>
            <select class="form-select" id="select_user" required>
                <option value=""></option>
            </select>
        </div>
        <input type="hidden" name="password" id="password">
        <div class="form-group">
            <label for="">NIK</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" required=""
                readonly>
        </div>
        <div class="form-group">
            <label for="">Name</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required=""
                readonly>
        </div>

        <div class="form-group">
            <label for="">Divisi</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="division" name="division" placeholder="Divisi"
                required="" readonly>
        </div>
        <div class="form-group">
            <label for="">Email</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required=""
                readonly>
        </div>
        <div class="form-group">
            <label for="">User ID</label><span style="color:red;">*</span>
            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID"
                required="" readonly>
        </div>

        <div class="form-group">
            <label for="">Roles</label><span style="color:red;">*</span>
            <select name="roles" id="roles" class="" style="width: 100%;" required>
                <option value=""></option>
                {{-- @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach --}}
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
    var comp = [];
    $.ajax({
        type: "get",
        url: "/company-api",
        async: false,
        dataType: "json",
        success: function(data) {
            var temp = data.employee;
            temp.forEach(e => {
                e.id = e.comp_name;
                e.text = e.comp_name;
            });

            comp = temp;
        }
    });
</script>
<script>
    var select2_company = $('#company').select2({
        theme: 'bootstrap',
        data: comp,
        placeholder: 'Select Company'
    });
    var selected_comp = $('#company').val();
    $('#company').change(function() {
        selected_comp = $(this).val();
        select2_user.val('').trigger('change');
        clearField();
    })

    var employee = [];
    var select2_user = $('#select_user').select2({
        theme: 'bootstrap',
        placeholder: 'Select User',
        ajax: {
            delay: 300,
            url: '/employee-api',
            async: false,
            data: function(params) {
                var query = {
                    search: params.term,
                    company: selected_comp
                }
                return query;
            },
            processResults: function(data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                var temp = data.employee;
                employee = data.employee;
                temp.forEach(e => {
                    e.id = e.user_id;
                    e.text = e.user_name + ' - ' + e.user_nik;
                });
                return {
                    results: temp
                };
            }
        }
    });

    var select2_roles = $('#roles').select2({
        theme: 'bootstrap',
        placeholder: 'Select Roles',
        async: false,
        search: false,
        ajax: {
            delay: 300,
            url: '/get-role',
            data: function(params) {
                var query = {

                    company: selected_comp
                }
                return query;
            },
            processResults: function(data) {
                var temp = JSON.parse(data);

                temp.forEach(e => {
                    e.text = e.description;
                });
                console.log(temp);
                return {
                    results: temp,
                }
            },
        }
    });

    $('#select_user').change(function(e) {
        e.preventDefault();
        if ($(this).val()) {
            id = $(this).val();
            var selected_emloyee = employee.find(function(e) {

                return e.user_id == id;
            })
            console.log(selected_emloyee);
            $('#name').val(selected_emloyee.user_name);
            $('#nik').val(selected_emloyee.user_nik);
            $('#division').val(selected_emloyee.divisi_name);
            $('#password').val(selected_emloyee.user_password);
            $('#email').val(selected_emloyee.user_email);
            $('#user_id').val(selected_emloyee.user_login);
        }

    });

    var field = ['name', 'nik', 'division', 'email', 'user_id'];

    function clearField() {
        field.forEach(f => {
            $('#' + f).val('');
        });
    }
</script>
