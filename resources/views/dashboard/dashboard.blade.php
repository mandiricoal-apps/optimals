@extends('layout')
@section('dashboard', 'active')
@section('css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
@stop
@section('content')

    <div class="row">

        @if ($countCompany->count() < 3)
            @php
                $text = '';
                $temp = [];
                foreach ($countCompany as $count) {
                    $temp[] = $count->company;
                }

                if ($countCompany->count() == 0) {
                    $text = 'MIP, MKP, RML';
                } else {
                    foreach (company() as $key => $com) {
                        if (!in_array($com, $temp)) {
                            $text .= $com . ', ';
                        }
                    }
                }

            @endphp
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ $text }}</strong> has not carried out daily inspections today !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="page-header p-0">
            <h3 class="page-title">Dashboard Daily Inspection
                {{ 'in ' . (request()->company && request()->company != 'all' ? request()->company : '') . ' ' }}
                <small>({{ isset($title_date) ? $title_date : date('F Y') }})</small>
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><b><?= date('D,') ?></b> <?= date('d F Y') ?></li>
                </ol>
            </nav>
        </div>

        <form action="/" onsubmit="showLoader();" method="GET">
            <div class="row">

                <div class="col-2">
                    <div class="form-group">
                        <label for="">From</label>
                        <input type="date" class="form-control  form-control-sm" id="from" placeholder="from"
                            name="from" required="" value="{{ request()->from ?? date('Y-m-01') }}">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="date" class="form-control form-control-sm" id="to" placeholder="to"
                            name="to" required=""
                            value="{{ request()->to ?? date('Y-m-d', strtotime('last day of this month')) }}">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="">Company</label>
                        <select class="form-control form-control-sm" id="company" name="company" required>
                            @if (isset(request()->company) && request()->company != 'all')
                                <option value="{{ request()->company }}">{{ request()->company }}</option>
                            @endif
                            <option value="all">All Company</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <label for=""></label>
                    <button type="submit" class="btn btn-primary mr-2 form-control form-control-sm"><i
                            style="font-size: 14px;" class="mdi mdi-content-save"></i> Search </button>
                </div>
                <div class="col"></div>
            </div>
        </form>

        <div class="col-xl-4 p-3">
            <h5>Total Daily Inspection by Company</h5>
            <hr>
            <div class="card stretch-card mb-2 p-2">
                <div class="card-body d-flex flex-wrap justify-content-between" style="padding: 28px">
                    <div>
                        <img src="/assets/images/logo/mip.png" width="50px">
                    </div>
                    <div>
                        <h4 class=" font-weight-bold mb-1 text-black"> PT MIP </h4>
                        <h6 class="text-muted">PT Mandiri Intiperkasa</h6>
                    </div>
                    <h4 class=" font-weight-bold">{{ $MIP }}</h4>
                </div>
            </div>
            <div class="card stretch-card mb-2">
                <div class="card-body d-flex flex-wrap justify-content-between" style="padding: 28px">
                    <div>
                        <img src="/assets/images/logo/mkp.png" width="50px">
                    </div>
                    <div>
                        <h4 class=" font-weight-bold mb-1 text-black"> PT MKP </h4>
                        <h6 class="text-muted">PT Mandala Karya Prima</h6>
                    </div>
                    <h4 class=" font-weight-bold">{{ $MKP }}</h4>
                </div>
            </div>
            <div class="card stretch-card mb-2">
                <div class="card-body d-flex flex-wrap justify-content-between" style="padding: 28px">
                    <div>
                        <img src="/assets/images/logo/rml.png" width="50px">
                    </div>
                    <div>
                        <h4 class=" font-weight-bold mb-1 text-black"> PT RML </h4>
                        <h6 class="text-muted">PT Riung Mitra Lestari</h6>
                    </div>
                    <h4 class=" font-weight-bold">{{ $RML }}</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-4  p-3">
            <h5>Percentage Daily Inspection by Company</h5>
            <hr>
            <div class="row">
                <div class="card">
                    <div class="card border-0">
                        <div class="card-body mb-1">
                            <div class="d-flex flex-wrap">
                                <div class="doughnut-wrapper w-80">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div id="doughnut-chart-legend"
                                    class="pl-lg-6 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 p-3">
            <h5>Total Score by Area</h5>
            <hr>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item  align-items-center mb-2" style="padding: 0.3rem;">
                            <b>&emsp; Criteria :</b><br>
                            <small>
                                &emsp;🟢 <b>> 80%</b> (Very Good) &nbsp;🔵 <b>70% > 79%</b> (Good)<br>
                                &emsp;🟠 <b>61% > 69%</b> (Fair) &emsp;🔴 <b>
                                    < 60%</b> (Fool)<br>
                            </small>
                        </li>
                    </ul>


                    <ul class="list-group">
                        @foreach ($area as $area)
                            @php
                                $total = 0;
                                foreach ($per_area as $value) {
                                    if ($value->id == $area->id) {
                                        $total = $value->total_score;
                                    }
                                }
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                style="padding: 0.45rem 1.25rem;">
                                {{ $area->area_name }}
                                <span class="badge badge-{{ colorScore($total) }} badge-pill"
                                    style="width:80px;font-size: 12px;">{{ round($total, 2) }}%</span>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>


        <div class="col-xl-4 p-3">
            <h5>Total ISSUE by Status</h5>
            <hr>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        @foreach (issue() as $key => $val)
                            @php
                                $total = 0;
                                foreach ($issue as $i) {
                                    if ($i->status == $key) {
                                        $total = $i->total;
                                    }
                                }
                            @endphp
                            @foreach ($issue as $i)
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                style="padding: 0.45rem 1.25rem;">
                                <b>{{ $val }}</b><span class=""
                                    style="font-size: 15px;">{{ $total }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-8 p-3">
            <h5>TOP 5 ISSUE of Daily Inspection</h5>
            <hr>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th scope="col" width="20%">Last Update</th>
                                <th scope="col" width="60%">Issue</th>
                                <th scope="col" width="20%" style="text-align:center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastIssue as $is)
                                <tr>
                                    <td>
                                        {!! tanggalTable($is->updated_at) !!}
                                    </td>
                                    <td>
                                        {{ $is->code }}<br>
                                        <small><b>Description :</b> {{ $is->issue }}</small>
                                    </td>
                                    <td style="text-align:center;"><i>{{ ucfirst($is->status) }}</i></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <hr>
                    @can('view_issue')
                        <div class="text-end">
                            <i><small>*For more information click Menu ISSUE or click <a href="/issue">here</a></small></i>
                        </div>
                    @endcan
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
        </script>

        <!-- Custom JS, Chart JS -->
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['MIP', 'MKP', 'RML'],
                    datasets: [{
                        label: '#dailyinspection',
                        data: [{{ $MIP }}, {{ $MKP }}, {{ $RML }}],
                        borderWidth: 1,
                        backgroundColor: [
                            'crimson',
                            'darkorange',
                            'dodgerblue'
                        ],

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
