@extends('admin.admin')

@section('title')
    Nursing Cart
@endsection

@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="block pentacare-bg">
                <div class="block-header with-border" style="background: rgb(51, 70, 128, 0.8)">
                    <h4 class="block-title text-white">Ward Inventory</h4>
                    <div class="block-options">
                        <a href="{{route('inpatient.dashboard')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                        @if ($recieved->count())


                        <select name="id" id="select-supply" class="form-control" required>
                            <option selected disabled>choose one...</option>
                        @foreach ($recieved as $item)
                        <option value="{{$item->id}}">{{$item->created_at->format('d/M/Y H:i a') }} for collection</option>
                        @endforeach
                        </select>


                    @endif

                </div>
            </div>
                <div class="block-content block-content-full pentacare-bg">
<div class="table-responsive">
<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
    <thead>
        <tr>
            <th class="text-center" style="width:3%;">S/No</th>
            <th> Name</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Form</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Drug Strength</th>

            <th class="d-none d-sm-table-cell" style="width: 15%;"><span>Reorder Level</span></th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Quantity Available</th>


            <th style="width: 15%;">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carts as $drug)

            <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                <td class="font-w600 font-size-sm">
                <a href="{{route('nursecart.show', $drug->id)}}">{{$drug->drugModel->name}}</a>
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->drugModel->forms}}
                </td>
                <td class="d-none d-sm-table-cell text-center">
                {{$drug->drugModel->strength}}
                </td>

                <td class="d-none d-sm-table-cell text-center">
                    <span class="badge badge-warning">{{$drug->reorder_level}}</span><br>
                </td>
                <td>
                    {{$drug->available}}
                </td>
                <td>
                    {{-- <div class="btn-group">
                        <button  class="btn btn-sm btn-primary drugedit" data-gate="{{route('drug.update', $drug->id)}}"
                        data-subcategory="{{$drug->drugClass->id}}"
                        data-name="{{$drug->name}}" data-form="{{$drug->forms}}"  data-strength="{{$drug->strength}}" data-maximum_level="{{$drug->maximum_level}}" data-minimum_level="{{$drug->minimum_level}}" data-reorder_level="{{$drug->reorder_level}}" data-toggle="modal" data-target="#drug-block-normal" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div> --}}
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
<div class="modal" id="purchase-block-normal" tabindex="-1" role="dialog" aria-labelledby="purchase-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-top" role="document" >
        <div class="modal-content">
            <div class="block block-themed pentacare-bg block-transparent mb-0">
                <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                    <h3 class="block-title text-white" >stock Cart </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form class="form form-element" action="{{ route('receive.stock')}}" method="POST">
                            @csrf
                    <h2 class="block-title text-center text-success mt-5">Receive Consumables/Drugs for <span id="carttype"></span></h2>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="ml-auto">Cart Location</label>
                                    <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="text" id="cart" readonly class="form-control form-control-lg">
                                </div>

                                <div class="form-group col-md-4 ml-auto">
                                    <label class="ml-auto">Total</label>
                                    <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="text" id="totalPurchase"  readonly placeholder="0" class="form-control form-control-lg">
                                </div>
                                <input type="hidden" name="id" id="stock-id">
                            </div>
                            <h2 class="text-center">Stock Cart</h2>
                        <div class="table-responsive">


                                <table class="table table-bordered table-striped" id="cartstock">
                                    <thead>
                                    <th>Drug Name</th>
                                    <th>form / strength</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>


                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg custom-control-info mb-1">
                                    <input type="checkbox" class="custom-control-input" id="example-cb-custom-square-lg1" name="recieve" required>
                                    <label class="custom-control-label" for="example-cb-custom-square-lg1">Confirm received</label>
                                </div>
                            </div>



                        <button  id="drugSubmit" type="submit"  class="btn btn-primary ml-auto" >Submit

                        </button>


                    </form>


                    </div>

                </div>

                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
</div>

@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>
<script>
    $(function(){
        $('#select-supply').change(function(){
            let id = $(this).val();
            let url = "{{url('admin/processtock')}}"+ '/' + id;
            $.get(url, showPrescription);
            $('#purchase-block-normal').modal().show();

        });
        function showPrescription(data){
            console.log(data);
            $('#cartstock tbody').html('');
                $('#totalPurchase').val(data.cartrestock.costs);
                $('#cart').val(data.cartrestock.cart_type);
                $('#carttype').text(data.cartrestock.cart_type);
                $('#supplied').val(data.supplied_by);
                $('#stock-id').val(data.cartrestock.id);
            $.each(data.stockdetails, function(key, value){
                 setTimeout(function(){
            let tablerow = `
                <tr>

                    <td>
                        <input type="text" value="${value.drugName}" class="form-control"  readonly >

                    </td>
                    <td>
                        <input type="text"  value="${value.drug_form}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text"  value="${value.unit}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text"  value="${value.quantity}" class="form-control drugDuration" readonly>
                    </td>
                    <td>
                        <input type="text"  value="${value.cost}" class="form-control quantity" readonly>
                    </td>


                </tr>`;

                $('#cartstock tbody').append(tablerow);}
                    , 200);
                    });



        }
     });
</script>



@endsection
