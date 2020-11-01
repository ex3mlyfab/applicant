@extends('admin.admin')

@section('title')
{{$supplier->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow pentacare-bg">
            <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                <h3 class="block-title text-white">{{$supplier->name  }}</h3>


            </div>
            <div class="block-content block-content-full pentcare-bg">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <p class="mr-2" style="font-size: 17px">Supplier Name</p>
                                <h3 class="mr-2" style="font-size: 18px">{{$supplier->name}}</h3>

                            </div>
                        </div>
                        <div class="pentacare-bg border-top">
                            <div class="content content-boxed">
                                <div class="row items-pus text-center">
                                    <div class="col-md-4 border-right">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-success-light">Company contact Phone</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                          <span class="badge badge-pill badge-success">{{$supplier->contact_phone}}</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 border-right">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-danger-light">Contact Person</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-danger">{{$supplier->contact_person_name}}</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-warning-light">Address</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-warning">{{$supplier->address}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <div class="content bg-default-lighter">
                        <div class="font-size-sm font-w600 text-muted text-uppercase text-center bg-danger-light">Dealings details</div>
                        <div class="row text-center">

                            <div class="col-md-3 border">
                                <div class="font-size-sm font-w600 text-muted text-uppercase bg-modern-light">Total Business</div>
                            <span class="badge badge-success"> ₦ {{ number_format($supplier->recieveOrders->sum('costs'), 2, '.', ',') }}</span>
                            </div>
                            <div class="col-md-3 border">
                                <div class="font-size-sm font-w600 text-muted text-uppercase bg-modern-light">Total Business this year</div>

                                <span class="badge badge-success"> ₦{{ number_format($supplier->recieveOrders->sum('costs'), 2, '.', ',')}}</span>
                            </div>
                            <div class="col-md-3 border">
                                <div class="font-size-sm font-w600 text-muted text-uppercase bg-modern-light">Total paid</div>
                               <span class="badge badge-info"> ₦ {{ $supplier->supplierPurchases->sum('amount_paid')}}</span>
                            </div>
                            <div class="col-md-3 border">
                                <div class="font-size-sm font-w600 text-muted text-uppercase bg-modern-light">Total credit</div>
                               <span class="badge badge-info"> ₦  {{number_format($supplier->supplierPayables->sum('amount_to_be_paid'),2, '.',',') }}</span>

                            </div>
                        </div>

                    </div>
                    <div class="row pt-1">
                        <div class="col-md-6">
                        <a href="{{route('supplier.purchase', $supplier->id)}}" class="btn btn-outline-primary">Payments</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{route('supplier.payable', $supplier->id)}}" class="btn btn-outline-secondary">Payables</a>
                        </div>
                    </div>

                    </div>
                </div>
                    <hr>

                <div class="table-responsive pentacare-bg">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>
                                s/no
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Received By
                            </th>
                            <th>
                                Total
                            </th>

                            <th>
                                Payment Status
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($supplier->recieveOrders as $item)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                    <a href="{{route('recieveorder.show', $item->id)}}">{{$item->created_at->format('d-M-Y H:i A')}}</a>
                                    </td>
                                    <td>
                                        {{$item->admin->name}}
                                    </td>
                                    <td>
                                       {{number_format($item->costs, 2, '.', ',')}}
                                    </td>
                                    <td>
                                        {{$item->payment_status}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('foot_js')


@endsection
