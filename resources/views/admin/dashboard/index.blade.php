@extends('admin.admin')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="content" style="border-radius: 10px; background: rgba(255, 255, 255, 0.4)">
    <div class="block" style="border-radius: 10px; background: rgba(255, 255, 255, 0.4)">
        <div class="block-content">
            @role('super-admin')
            <div class="row">

                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">

                        <div class="block-content d-flex">
                            <div>
                                <i class="fa fa-2x ml-2 p-2 fa-wheelchair text-center img-avatar img-avatar48 img-avatar-thumb text-danger bg-gray-light"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <span class="text-center float-center" style="font-size: 25px; margin-left: 60px">{{ $consult}}</span>
                                    <div class="block-header">
                                        <h3 style="font-size: 12px" class="block-title text-center">consultation</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">

                        <div class="block-content d-flex">
                            <div>
                                <i class="fa fa-2x ml-2 p-2 fa-bed text-center img-avatar img-avatar48 img-avatar-thumb text-danger bg-gray-light"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <span class="text-center float-center" style="font-size: 25px; margin-left: 45px">{{ $admit}}</span>
                                    <div class="block-header">
                                        <h3 style="font-size: 12px" class="block-title text-center">New admit</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">

                        <div class="block-content d-flex">
                            <div>
                                <i class="fa fa-2x ml-2 p-2 fa-cut text-center img-avatar img-avatar48 img-avatar-thumb text-danger bg-gray-light"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <span class="text-center float-center" style="font-size: 25px; margin-left: 45px">{{ $operation}}</span>
                                    <div class="block-header">
                                        <h3 style="font-size: 12px" class="block-title text-center">operation</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="block block-fx-pop block-rounded">

                        <div class="block-content d-flex">
                            <div>
                                <i class="fa fa-2x ml-2 p-2 fa-hand-holding-usd text-center img-avatar img-avatar48 img-avatar-thumb text-danger bg-gray-light"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <span class="text-center float-center" style="font-size: 22px; margin-left: 45px">₦{{ $earning}}</span>
                                    <div class="block-header">
                                        <h3 style="font-size: 12px" class="block-title ml-3 text-center">earnings</h3>
                                    </div>
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
                        <h3 class="block-title text-center">Hospital survey

                        </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <canvas class="js-chartjs-bars"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                            <div class="block" style="border-radius: 5px">
                                <div class="block-header">
                                    <h3 class="block-title">Donut</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                        <canvas class="js-chartjs-donut chartjs-render-monitor" width="500" height="400" style="display: block; width: 248px; height: 124px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot_js')
<script src="{{asset('backend')}}/assets/js/oneui.core.min.js"></script>
<script src="{{asset('backend')}}/assets/js/oneui.app.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

<script src="{{asset('backend')}}/assets/js/pages/be_comp_charts.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/chart.js/Chart.bundle.min.js"></script>
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
