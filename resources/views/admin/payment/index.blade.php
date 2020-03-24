@extends('admin.admin')

@section('title')
Payments information
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">


@endsection

@section('content')
    <div class="content">
        <div class="col-12">
             <!-- Block Tabs With Options Default Style -->
             <div class="block">
                <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswo-static-home">Invoice List {{ now()->today()->format('d/M/Y')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswo-static-profile">Payments List {{ now()->today()->format('d/M/Y')}}</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="block-options pl-3 pr-2">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>

                        </div>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                        @include('admin.payment.includes.invoices')
                    </div>
                    <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                        @include('admin.payment.includes.payments')
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('public/backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>
<script>

</script>

@endsection
