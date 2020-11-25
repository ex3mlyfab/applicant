@extends('admin.admin')

@section('title')
    bank transfers
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="block block-fx-shadow pentacare-bg">
            <div class="block-header bg-info-light">
                <h3 class="block-title">
                    All Transfers to {{ $bank->name.'/'. $bank->account_name}}
                </h3>
                <div class="block-option">
                <a href="{{route('bank.index')}}" class="btn btn-outline-secondary"><i class="fa fa-door-open"></i>
                Go back</a>
                </div>
            </div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($bank->bankTransfers as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->user->full_name}}</td>
                                    <td>₦ {{number_format($item->amount_transfered,2, '.',',')}}</td>
                                    <td>
                                       {{$item->status}}
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>

@endsection
