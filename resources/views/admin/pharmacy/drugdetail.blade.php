@extends('admin.admin')

@section('title')
{{$drug->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow">
            <div class="block-header bg-info-light">
                <h3 class="block-title">{{$drug->name  }}</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#batch"> Add New Drug Batch</button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-6 border-right">
                                <p>Drug Name</p>
                                <h3 class="display-4">{{$drug->name}}</h3>
                            </div>

                            <div class="col-md-3 border-right">

                            </div>

                        </div>
                        <div class="bg-white border-top">
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
                                            {{$item->brought_forward}}
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
    <div class="modal" id="batch" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-md" role="document"style=" width: 80%;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title">Add Drug Batch </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                    <form action="{{route('drugbatch.store')}}" method="post">
                            @csrf
                            <div class="form-group form-row">
                                <label for="name">drug Name</label>
                                <input type="text"  id="name" value="{{ $drug->name}}"  class="form-control form-control-lg" disabled >
                            <input type="hidden" name="drug_model_id" value="{{ $drug->id}}">
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <label for="bn">Batch_no (Receipt_no)</label>
                                    <input type="text" name="batch_no" id="bn"   class="form-control form-control-lg"  >
                                </div>
                                <div class="col-md-6">
                                    <label for="ed"> Quantity Purchased</label>
                                <input type="number" name="quantity_supplied" id="ed"   class="form-control form-control-lg"  >
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
                                <div class="col-md-6"><label for="cost">Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₦ </span>
                                        <input type="number" name="cost" id="cost"   class="form-control" readonly required>
                                    </div>
                                </div></div>

                            </div>
                            <div class="form-group form-row">
                                <label for="supplier"> Name of Supplier</label>
                                <input type="text" name="supplier" id="supplier"   class="form-control" >
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
<script src="{{asset('public/backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>
<script>
    $(function(){

        $('#purchase_price').blur(function(){
            $('#cost').val(parseFloat($(this).val()) * 1.5);
        });
    });
</script>


@endsection
