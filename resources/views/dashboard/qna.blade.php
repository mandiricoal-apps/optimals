@extends('layout')
@section('qna', 'active')


@section('content')
@section('css')
    <style>
        #area-card {
            cursor: pointer;
        }

        #area-card:hover {
            transform: scale(1.1);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>
@stop
<div class="card">
    <div class="card-body">
        <div class="row">
            @foreach ($areas as $area)
                <div class="col-12 col-md-4">
                    <a href="/question/{{ $area->id }}" onclick="showLoader()" style="text-decoration: none">
                        <div class="card card-statx stretch-card mb-3" id="area-card"
                            style="background-image: url(assets/images/dashboard/img_7.jpg">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="text-white">
                                        <div style="color: #ffffff;">
                                            <h3 class="font-weight-bold mb-0">{{ $area->area_name }}<i
                                                    class="mdi mdi-arrow-top-right"></i></h3>
                                        </div>
                                        <h6>{{ $area->description }}</h6>
                                        <div class="badge badge-danger">
                                            <span class="mdi mdi-file-question"></span>
                                            {{ $area->question->count() }} questions
                                        </div>
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
@endsection