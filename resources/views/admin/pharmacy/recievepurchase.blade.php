@extends('admin.admin')

@section('title')
 Recieve Orders
@endsection
@section('head_css')
<link rel="stylesheet" href="{{ url('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection
@section('content')
<div class="content">
    <div class="block block-fx-pop block-rounded pentacare-bg">
        <div class="block-header bg-info-light text-uppercase">Save new orders recieved
        </div>
        <div class="block-content block-content-full">
        <form action="{{ route('recieveorder.store')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="supplier">Supplier</label>
                <input type="text" id="supplier" class="form-control form-control-lg" value="{{ $recieveOrder->supplier->name}}" readonly>
                <input type="hidden" name="supplier_id" value="{{ $recieveOrder->supplier_id}}">
                </div>
                <div class="form-group col-md-4 ml-auto">
                    <label for="receipt_no" class="text-right ml-auto">Receipt Number

                    </label>
                    <input type="text" name="receipt_no" id="receipt_no" class="form-control form-control-lg">
                    <input type="hidden" name="purchase_order_id" value={{ $recieveOrder->id }}>
                    <label for="date_received">Date Recieved</label>
                    <input type="text" name="purchase_date" id="date_received" class="js-datepicker form-control form-control-lg" data-autoclose="true" data-today-highlight="true"
                    data-week-start="1" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>

                </div>
            </div>

                <h3 class="text-uppercase text-center">Receive Order Details</h3>


            <div class="table-responsive">
                <table class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th rowspan="2">
                                Drug Name
                            </th>
                            <th colspan="2">
                                Request
                            </th>
                            <th colspan="5" class="text-center bg-modern-op text-white">
                                recieved
                            </th>
                        </tr>
                        <tr>
                            <th>qty</th>
                            <th>price</th>
                            <th class="text-center bg-info-light">qty</th>
                            <th class="text-center bg-info-light">price</th>
                            <th class="text-center bg-info-light">total cost</th>
                            <th class="text-center bg-info-light">sales. p</th>
                            <th class="text-center bg-info-light">Expiry date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recieveOrder->purchaseOrderDetails as $item)
                            <tr id="row{{$loop->iteration}}">
                                <td>
                                    {{$item->drugModel->name . ' '.$item->drugModel->forms }}
                                <input type="hidden" name="drug_model_id[]" value="{{ $item->drugModel->id }}">
                                </td>
                                <td>
                                    {{ $item->quantity_needed}}
                                </td>
                                <td>
                                    {{ $item->price }}
                                </td>
                                <td>
                                    <input type="text" name="quantity_needed[]"  class="form-control qty" required>
                                </td>
                                <td>
                                    <input type="number" name="price[]"  step="0.1" class="form-control price text-right" data-row="{{$loop->iteration}}" required>
                                </td>
                                <td>
                                    <input type="text" name="linecost[]" class="form-control linecost" readonly>
                                </td>
                                <td>
                                    <input type="number" name="selling_price[]"  class="form-control selling text-right" required>
                                </td>

                                <td>
                                    <input type="text" name="expiry_date[]" class="js-datepicker form-control expiry" data-autoclose="true" data-today-highlight="true"
                                    data-week-start="1" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> Total Cost</label>
                            <input type="text" name="cost" class="form-control form-control-lg" id="totalCost" readonly required>
                        </div>
                        <div class="form-group col-md-4 ml-auto">
                            <label>Payment Mode</label>
                            <div class="custom-control custom-radio payment custom-control-lg mb-1">
                                <input type="radio" name="payment_mode" id="debit" class="custom-control-input" value="debit" required>
                                <label for="debit" class="custom-control-label">Cash</label>
                            </div>
                            <div class="custom-control custom-radio payment custom-control-lg mb-1">
                                <input type="radio" name="payment_mode" id="credit" class="custom-control-input" value="credit" required>
                                <label for="credit" class="custom-control-label">Credit</label>
                            </div>

                        </div>
            </div>
            <div class="row d-flex justify-content-center">
                <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>

        </form>

    </div>
    </div>

</div>

@endsection
@section('foot_js')
<script src="{{ url('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        jQuery(function(){
            One.helpers(['datepicker']);
            $('.price').bind('blur', function(){
                let price = parseFloat($(this).val());
                let rowId = $(this).data('row');
                let qty =  parseInt($('#row'+rowId+ ' .qty').val());
                qty = qty ? qty : 0;
                let total_amount = price * qty;
                $('#row'+rowId+ ' .linecost' ).val(total_amount);
            });

            $('.payment').bind('change', function(){
                let totalCost = 0;
                $('.linecost').each(function(){
                    totalCost += parseFloat($(this).val());
                });
                console.log(totalCost);
                $('#totalCost').val(totalCost);
            });
        });
    </script>
@endsection
