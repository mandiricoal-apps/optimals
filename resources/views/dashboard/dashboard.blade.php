@section('css')
<!-- Select2 CSS -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
<link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
@stop

@extends('layout')
@section('dashboard', 'active')
@section('content')

<div class="row">
<!--     <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Hallo Admin !</strong> Welcome to administrator page.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>MKP, RML</strong> has not carried out daily inspections today !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="page-header p-0">
        <h3 class="page-title">Dashboard Daily Inspection <small>(2023)</small></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><b><?= date("D,"); ?></b> <?= date("d F Y"); ?></li>
            </ol>
        </nav>
    </div>

    <form action="#" onsubmit="showLoader();" method="POST">
        <div class="row">
            @csrf
            <div class="col-2">
                <div class="form-group">
                    <label for="">From</label>
                    <input type="date" class="form-control  form-control-sm" id="from" placeholder="from" required="">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">To</label>
                    <input type="date" class="form-control form-control-sm" id="to" placeholder="to" required="">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Company</label><span style="color:red;">*</span>
                    <select class="form-control form-control-sm" id="company" name="company" required>
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <label for=""></label>
                <button type="submit" class="btn btn-primary mr-2 form-control form-control-sm" ><i style="font-size: 14px;" class="mdi mdi-content-save"></i> Search </button>
            </div>
            <div class="col"></div>
        </div>
    </form>

    <div class="col-xl-4 p-3">
        <h5>Total Daily Inspection by Company</h5><hr>
        <div class="card stretch-card mb-2 p-2" >
            <div class="card-body d-flex flex-wrap justify-content-between" style="padding: 28px">
                <div>
                    <h4 class="text-danger font-weight-bold mb-1 text-black"> PT MIP </h4>
                    <h6 class="text-muted">PT Mandiri Intiperkasa</h6>
                </div>
                <h4 class=" font-weight-bold">123</h4>
            </div>
        </div>
        <div class="card stretch-card mb-2">
            <div class="card-body d-flex flex-wrap justify-content-between" style="padding: 28px">
                <div>
                    <h4 class="text-warning font-weight-bold mb-1 text-black"> PT MKP </h4>
                    <h6 class="text-muted">PT Mandala Karya Prima</h6>
                </div>
                <h4 class=" font-weight-bold">212</h4>
            </div>
        </div>
        <div class="card stretch-card mb-2">
            <div class="card-body d-flex flex-wrap justify-content-between" style="padding: 28px">
                <div>
                    <h4 class="text-info font-weight-bold mb-1 text-black"> PT RML </h4>
                    <h6 class="text-muted">PT Riung Mitra Lestari</h6>
                </div>
                <h4 class=" font-weight-bold">265</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-4  p-3">
        <h5>Percentage Daily Inspection by Company</h5><hr>
        <div class="row">
            <div class="card">
                <div class="card border-0">
                    <div class="card-body mb-1">
                        <div class="d-flex flex-wrap">
                            <div class="doughnut-wrapper w-80">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div id="doughnut-chart-legend" class="pl-lg-6 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 p-3">
        <h5>Total Score by Area</h5><hr>
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item  align-items-center mb-2" style="padding: 0.3rem;">
                        <b>&emsp; Criteria :</b><br>
                        <small>
                            &emsp;🟢 <b>> 80%</b> (Very Good) &nbsp;🔵 <b>70% > 79%</b> (Good)<br>
                            &emsp;🟠 <b>61% > 69%</b> (Fair) &emsp;🔴 <b>< 60%</b> (Fool)<br>
                        </small>
                    </li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                        Front Loading OB
                        <span class="badge badge-success badge-pill" style="width:80px;font-size: 12px;">81%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                       Front Loading Coal
                       <span class="badge badge-primary badge-pill" style="width:80px;font-size: 12px;">70%</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    Haul Road
                    <span class="badge badge-warning badge-pill" style="width:80px;font-size: 12px;">65%</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    Dewatering
                    <span class="badge badge-danger badge-pill" style="width:80px;font-size: 12px;">55%</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    Disposal
                    <span class="badge badge-primary badge-pill" style="width:80px;font-size: 12px;">72%</span>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="col-xl-4 p-3">
    <h5>Total ISSUE by Status</h5><hr>
    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    <b>Open</b><span class="" style="font-size: 15px;">50</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    <b>On Progress</b><span class="" style="font-size: 15px;">15</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    <b>Close</b><span class="" style="font-size: 15px;">52</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    <b>Cancel</b><span class="" style="font-size: 15px;">3</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0.45rem 1.25rem;">
                    <b>Reject</b><span class="" style="font-size: 15px;">12</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="col-xl-8 p-3">
    <h5>TOP 5 ISSUE of Daily Inspection</h5><hr>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" width="100%">
              <thead>
                <tr>
                    <th scope="col" width="20%">Creation Date</th>
                    <th scope="col" width="60%">Issue</th>
                    <th scope="col" width="20%" style="text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        12 Nov 2023<br>
                        <small><b>08:00 WITA</b></small>
                    </td>
                    <td>
                        <a href="#">23ILA0400008</a><br>
                        <small><b>Description :</b> Lorem imsum dolor amet</small>
                    </td>
                    <td style="text-align:center;"><i>Open</i></td>
                </tr>
                <tr>
                    <td>
                        12 Nov 2023<br>
                        <small><b>08:00 WITA</b></small>
                    </td>
                    <td>
                        <a href="#">23ILA0400008</a><br>
                        <small><b>Description :</b> Lorem imsum dolor amet</small>
                    </td>
                    <td style="text-align:center;"><i>Close</i></td>
                </tr>
                <tr>
                    <td>
                        12 Nov 2023<br>
                        <small><b>08:00 WITA</b></small>
                    </td>
                    <td>
                        <a href="#">23ILA0400008</a><br>
                        <small><b>Description :</b> Lorem imsum dolor amet</small>
                    </td>
                    <td style="text-align:center;"><i>On Progress</i></td>
                </tr>
                <tr>
                    <td>
                        12 Nov 2023<br>
                        <small><b>08:00 WITA</b></small>
                    </td>
                    <td>
                        <a href="#">23ILA0400008</a><br>
                        <small><b>Description :</b> Lorem imsum dolor amet</small>
                    </td>
                    <td style="text-align:center;"><i>Reject</i></td>
                </tr>
                <tr>
                    <td>
                        12 Nov 2023<br>
                        <small><b>08:00 WITA</b></small>
                    </td>
                    <td>
                        <a href="#">23ILA0400008</a><br>
                        <small><b>Description :</b> Lorem imsum dolor amet</small>
                    </td>
                    <td style="text-align:center;"><i>On Progress</i></td>
                </tr>
            </tbody>
        </table><hr>
        <div class="text-end">
          <i><small>*For more information click Menu ISSUE or click <a href="#">here</a></small></i>
      </div>
  </div>
</div>
</div>


@endsection
@section('js')

<!-- Select2 -->
<script src="assets/vendors/select2/select2.min.js"></script>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom JS, Get data company -->
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
        theme: 'bootstrap'
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
        }

    });

    var field = ['name', 'nik', 'division'];

    function clearField() {
        field.forEach(f => {
            $('#' + f).val('');
        });
    }
</script>

<!-- Custom JS, Chart JS -->
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['RML', 'MIP', 'MKP'],
      datasets: [{
        label: '#dailyinspection',
        data: [30.5, 9.5, 60],
        borderWidth: 1
    }]
  },
  options: {
      scales: {
        y: {
          beginAtZero: true
      }
  }
}
});
</script>
@stop
