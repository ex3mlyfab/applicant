@extends('admin.admin')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-content">
            @role('super-admin')
            <div class="row">
                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">
                        <div class="block-header">
                            <h3 class="block-title text-center">consultation</h3>
                        </div>
                        <div class="block-content">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <i class="fa fa-2x ml-2 p-2 fa-wheelchair text-center img-avatar img-avatar48 img-avatar-thumb text-danger bg-gray-light"></i>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="font-w400">{{ $consult}}</h4>

                                </div>
                                <div class="col-md-12 text-right">
                                    <h5 class="font-w300">Yesterday: {{$yest_consult}} consults</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">
                        <div class="block-header">
                            <h3 class="block-title text-center">new admit</h3>
                        </div>
                        <div class="block-content">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <i class="fa fa-bed fa-2x ml-2 p-2 text-center img-avatar img-avatar48 img-avatar-thumb text-warning bg-gray-light"></i>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="font-w400">{{ $admit}}</h4>

                                </div>
                                <div class="col-md-12 text-right">
                                    <h5 class="font-w300">Yesterday: {{$yest_admit}} addmin</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">
                        <div class="block-header">
                            <h3 class="block-title text-center">operation</h3>
                        </div>
                        <div class="block-content">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <i class="fa fa-cut ml-2 p-2 text-center img-avatar img-avatar48 img-avatar-thumb fa-2x text-amethyst bg-gray-light"></i>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="font-w400">{{ $operation}}</h4>

                                </div>
                                <div class="col-md-12 text-right">
                                    <h5 class="font-w300">Yesterday: {{$yest_operation}} operations</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">
                        <div class="block-header">
                            <h3 class="block-title text-center">earnings</h3>
                        </div>
                        <div class="block-content">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <i class="fa fa-hand-holding-usd ml-2 p-2 text-center img-avatar img-avatar48 img-avatar-thumb fa-2x text-succcess bg-gray-light">

                                    </i>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="font-w400">₦{{ $earning}}</h4>

                                </div>
                                <div class="col-md-12 text-right">
                                    <h5 class="font-w300">Yesterday earnings: ₦{{$yest_earning}} </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            <div class="row">
                <div class="col-md-8">
                    <div class="block block-fx-shadow">
                        <div class="block-header">
                            <h3 class="block-title text-center">Hospital survey</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <canvas class="js-chartjs-bars"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot_js')
<script src="{{asset('public/backend')}}/assets/js/plugins/chart.js/Chart.bundle.min.js"></script>
<script>

new Chart($(".js-chartjs-bars"), {
    "type": "bar",
    "data": {"labels":["Jan","Feb","Mar", "Apr", "May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
            "datasets":[
                {"label":"total patients","data":[12,13,34,56,34,52,12,13,34,56,34,52], "fill":false,
                "backgroundColor":"rgba(75,192,192,0.2)", "borderColor":"rgb(23,212,78)", "borderWidth": 1}]},"options":{
                    "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
                }
});
</script>

@endsection
