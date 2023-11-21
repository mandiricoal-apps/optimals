@extends('layout')
@section('daily_inspection', 'active')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    @foreach ($areas as $area)
                        <div class="col-12 col-md-4">
                            <a href="/daily-inspection-area/{{ $area->id }}?status=not-approved"
                                style="color: #ffffff; text-decoration: none">
                                <div class="card card-statx stretch-card mb-3" id="area-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-white">
                                                <h6>{{ $area->area_code }}</h6>
                                                <h3 class="font-weight-bold ">{{ $area->area_name }} <i
                                                        class="mdi mdi-arrow-top-right"></i></h3>

                                                <div class="badge badge-danger">{{ $area->dailyInspection->count() }}
                                                    daily inspection</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
