@extends('admin.admin')

@section('title')
{{$theatercart->drugModel->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow pentacare-bg">
            <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                <h3 class="block-title text-white">{{$theatercart->drugModel->name  }}</h3>
                <div class="block-option">
                    <a href="{{route('inpatient.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                    <a href="{{route('theatercart.index')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
                </div>

            </div>
            <div class="block-content block-content-full pentcare-bg">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <p class="mr-2" style="font-size: 17px">Drug Name</p>
                                <h3 class="mr-2" style="font-size: 18px">{{$theatercart->drug->name}}</h3>
                            </div>
                        </div>
                        <div class="pentacare-bg border-top">
                            <div class="content content-boxed">
                                <div class="row items-pus text-center">

                                    <div class="col-md-4">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-warning-light">Reorder level</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-warning">{{$theatercart->drug->reorder_level ?? ''}}</span>
                                        </a>
                                    </div>
                                </div>
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
                                    Supplied Date
                                </th>

                                <th>
                                    Quantity received
                                </th>
                                <th>
                                    B/F
                                </th>
                                <th>
                                    Balance
                                </th>
                                <th>
                                    Purchase Price
                                </th>
                                <th>
                                    cost
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($theatercart->theaterCartBatches as $item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{$item->created_at->format('d-M-Y')}}
                                        </td>
                                        <td>
                                            {{$item->quantity_supplied}}
                                        </td>

                                        <td>
                                            {{$item->brought_forward}}
                                        </td>
                                        <td>
                                            {{$item->available_quantity}}
                                        </td>
                                        <td>
                                            {{$item->theaterCart->drugModel->purchase_price}}
                                        </td>
                                        <td>
                                            {{$item->theaterCart->drugModel->cost}}
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
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>
<script>
    $(function(){

        $('#purchase_price').blur(function(){
            $('#cost').val(parseFloat($(this).val()) * 1.5);
        });
    });
</script>


@endsection
