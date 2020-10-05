@extends('admin.admin')

@section('title')
{{$drug->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow pentacare-bg">
            <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                <h3 class="block-title text-white">{{$drug->name  }}</h3>

            </div>
            <div class="block-content block-content-full pentcare-bg">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <p class="mr-2" style="font-size: 17px">Drug Name</p>
                                <h3 class="mr-2" style="font-size: 18px">{{$drug->name}}</h3>
                            </div>
                        </div>
                        <div class="pentacare-bg border-top">
                            <div class="content content-boxed">
                                <div class="row items-pus text-center">
                                    <div class="col-md-4 border-right">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-success-light">Maximum Level</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                          <span class="badge badge-pill badge-success">{{$drug->maximum_level}}</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 border-right">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-danger-light">Minimum level</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-danger">{{$drug->minimum_level}}</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-warning-light">Reorder level</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-warning">{{$drug->reorder_level}}</span>
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
                                    Purchase Date
                                </th>
                                <th>
                                    Expiry Date
                                </th>
                                <th>
                                    Quantity purchased
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

                                <th>
                                    Actions
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($drug->drugBatchDetails as $item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{$item->purchase_date}}
                                        </td>
                                        <td>
                                            {{$item->expiry_date}}
                                        </td>
                                        <td>
                                            {{$item->quantity_supplied}}
                                        </td>

                                        <td>
                                            {{$item->packing_quantity}}
                                        </td>
                                        <td>
                                            {{$item->balance}}
                                        </td>
                                        <td>
                                            {{$item->purchase_price}}
                                        </td>
                                        <td>
                                            {{$item->cost}}
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('drugbatch.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            </div>
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
