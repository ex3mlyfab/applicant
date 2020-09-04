@extends('admin.admin')

@section('title')
{{$asset->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow">
            <div class="block-header bg-info-light">
                <h3 class="block-title">{{$asset->name  }}</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-outline-primary w-100 mb-2" data-max="{{$asset->available}}" id="cool" data-toggle="modal" data-target="#assign"> Assign Asset</button>
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#batch"> Add New asset Batch</button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-6 border-right">
                                <p>asset Name</p>
                                <h3 class="display-4">{{ucfirst($asset->name)}}</h3>
                            </div>

                            <div class="col-md-3 border-right">

                            </div>
                            <div class="col-md-3 text-center">
                                <p>asset Category</p>
                                <h3>{{$asset->assetCategory->name}}</h3>
                            </div>
                        </div>


                    </div>
                </div>
                    <hr>
                     <!-- Block Tabs With Options Default Style -->
                     <div class="block">
                        <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#btabswo-static-home">{{ $asset->name }}  Purchases</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#btabswo-static-profile">{{ $asset->name }} Assignment</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <div class="block-options pl-3 pr-2">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                </div>
                            </li>
                        </ul>
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                        <div class="table-responsive">
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
                                    Actions
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($asset->assetPurchases as $item)
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
                                            {{$item->quantity}}
                                        </td>

                                        <td>
                                            {{$item->brought_forward}}
                                        </td>
                                        <td>
                                            {{$item->available_quantity}}
                                        </td>
                                        <td>
                                            {{$item->purchase_price}}
                                        </td>


                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('assetpurchase.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
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
                            <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Quantity Assigned
                                                </th>
                                                <th>
                                                    Assigned to
                                                </th>
                                                <th>
                                                    Date checked out
                                                </th>
                                                <th>
                                                    Return Date
                                                </th>
                                                <th>
                                                    Date Check in
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($asset->assetAssigns as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>{{$item->quantity_assigned}}</td>
                                                <td>{{$item->assigned_to}}</td>
                                                <td>{{$item->date_assigned}}</td>
                                                <td>{{$item->check_in_date}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{route('assetassign.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
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
                    <!-- END Block Tabs With Options Default Style -->


            </div>
        </div>
    </div>
    <div class="modal" id="batch" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-popin modal-md" role="document"style=" width: 80%;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title">Add {{$asset->name}} purchase</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                    <form action="{{route('assetpurchase.store')}}" method="post">
                            @csrf
                            <div class="form-group form-row">
                                <label for="name">Asset Name</label>
                                <input type="text"  id="name" value="{{ $asset->name}}"  class="form-control form-control-lg" disabled >
                            <input type="hidden" name="asset_model_id" value="{{ $asset->id}}">
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <label for="bn">vendor</label>
                                    <input type="text" name="vendor" id="bn"   class="form-control form-control-lg"  >
                                </div>
                                <div class="col-md-6">
                                    <label for="ed"> Quantity Purchased</label>
                                <input type="number" name="quantity" id="ed"   class="form-control form-control-lg"  >
                            </div>

                            </div>

                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <label for="pd"> Purchase Date</label>
                                <input type="text" name="purchase_date" id="pd"   class="js-datepicker form-control form-control-lg" data-week-start="1" data-autoclose="true" data-startDate="today" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required>
                            </div>
                                <div class="col-md-6">
                                    <label for="qs"> Expiry Date</label>
                                <input type="text" name="expiry_date" id="qs"   class="js-datepicker form-control form-control-lg" data-week-start="1" data-autoclose="true" data-startDate="today" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required>
                                </div>

                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <label for="purchase_price">Purchase Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₦ </span>
                                        <input type="number" name="purchase_price" id="purchase_price"   class="form-control" required>
                                    </div>
                                </div>
                                </div>

                            </div>
                            <div class="form-group form-row">
                                <label for="supplier"> Purchased by</label>
                                <input type="text" name="purchased_by" id="supplier"   class="form-control" >
                            </div>


                    </div>
                    <div class="block-content block-content-full text-right border-top">

                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>Ok</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="assign" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-md" role="document"style=" width: 80%;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title">Assign {{$asset->name}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                    <form action="{{route('assetassign.store')}}" method="post">
                            @csrf
                            <div class="form-group form-row">
                                <label for="name1">Asset Name</label>
                                <input type="text"  id="name1" value="{{ $asset->name}}"  class="form-control form-control-lg" disabled >
                            <input type="hidden" name="asset_model_id" value="{{ $asset->id}}">
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <label for="bn1">Assign To</label>
                                    <input type="text" name="assigned_to" id="bn1"   class="form-control form-control-lg"  >
                                </div>
                                <div class="col-md-6">
                                    <label for="ed1"> Quantity Assigned</label>
                                <input type="number" name="quantity_assigned" id="ed1"   class="form-control form-control-lg"  >
                            </div>

                            </div>

                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <label for="pd1"> Date Assigned</label>
                                <input type="text" name="date_assigned" id="pd1"   class="js-datepicker form-control form-control-lg" data-week-start="1" data-autoclose="true" data-startDate="today" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required>
                            </div>
                                <div class="col-md-6">
                                    <label for="qs1"> Date due for Return</label>
                                <input type="text" name="check_in_date" id="qs1"   class="js-datepicker form-control form-control-lg" data-week-start="1" data-autoclose="true" data-startDate="today" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required>
                                </div>

                            </div>



                    </div>
                    <div class="block-content block-content-full text-right border-top">

                        <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>Ok</button>
                    </div>
                </form>
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
    $('#cool').click(function(){
        $('#ed1')..attr('max', $(this).data('max'));
    });
});
</script>


@endsection
