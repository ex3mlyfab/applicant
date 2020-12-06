@extends('admin.admin')

@section('title')
Purchase Order details
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="block block-fx-shadow">
            <div class="block-header bg-info-light">Purchase Orders Raised on {{ date('d-M-Y H:i A') }}
                <div class="block-options">
                <a id="btn-add" href="{{ route('purchaseOrder.index') }}" class="btn btn-primary btn-xs" >Back to Purchase Orders</a>
                </div>
            </div>
            <div class="block-content block-content-full">

            <form action="{{route('purchaseOrder.update', $purchaseOrder->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <h3 class="text-center">Order Purchase Details</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h2> Supplier: {{$purchaseOrder->supplier->name}}</h2>
                        </div>
                        <div class="col-md-6 text-right">
                        <h4>total:
                            <span id="total"> ₦{{ number_format($purchaseOrder->total,2,'.', ',') }}  </span> </h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bodered table-striped">
                            <thead>
                                <th>SN</th>
                                <th>Drug Name</th>
                                <th>price(₦)</th>
                                <th>Quantity</th>
                                <th> Cost(₦)</th>
                                <th class="bg-secondary text-white">action</th>
                            </thead>
                            <tbody>
                            @foreach ($purchaseOrder->purchaseOrderDetails as $item)
                                <tr id="row-{{$item->id}}">
                                        <td>
                                            {{$loop->iteration}}
                                            <input type="hidden" name="purchase_order_detail_id[]" value="{{$item->id}}">
                                        </td>
                                        <td>
                                            {{$item->drugModel->name}} - {{ $item->drugModel->forms }}
                                            -{{$item->drugModel->strength}}
                                        </td>
                                        <td class="price">
                                            {{$item->price}}
                                        </td>

                                        <td>
                                        <input type="number" name="qty[]" class="form-control form-control-lg qty" data-price="{{$item->price}}" data-id={{$item->id}} value="{{$item->quantity_needed}}" step="0.1">

                                        </td>
                                        <td>
                                        <input type="text" name="price[]" class="form-control form-control-lg cost-price" value="{{$item->price * $item->quantity_needed}}" readonly>

                                        </td>
                                        <td class="bg-secondary text-center">
                                            <input type="checkbox" name="approved[]" value="{{$item->id}}" data-amount="{{$item->price}}" class="form-checkbox form-checkbox-lg approval">
                                        </td>

                                    </tr>
                            @endforeach
                            </tbody>

                            <tr>
                                <td colspan="5" class="text-right">
                                        Approve all
                                </td>
                                <td>
                                    <input type="checkbox" class="form-checkbox" id="check_all">
                                </td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-lg btn-success submit">submit</button>

                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@section('foot_js')
<script>
    let stren = [];
    $(function(){
        $("#check_all").click(function(){
            $(".approval").prop('checked', $(this).prop('checked'));
            $('.submit').prop('disabled', false);

        });
        $('.submit').prop('disabled', true);

        $('.approval').bind('click', function(){
            if($(this).is(':checked')){
                $('.submit').prop('disabled', false);
            }else{
                $('.submit').prop('disabled', true);
            }
        });

        $('.qty').bind('blur', function(){
            // console.log($(this).val() * $(this).data('price'));
            let id = $(this).data('id');
            $('#row-'+id+' .cost-price').val($(this).val() * $(this).data('price'));
                let total = [];
                let paycontrol = [];
                $(".approval").each(function(){
                    if($(this).is(':checked')){
                        total.push($(this).val() * $(this).data('price'));
                        paycontrol.push(parseFloat($(this).val()));
                    }
                 });
                 let purchase = (Array.isArray(total) && total.length) ? total.reduce((total, amount) => total + amount, 0) : 0 ;
                $('#total').text(purchase.toFixed(2));
                if(purchase != 0){
                    $('#pay-control').val(paycontrol);
                $(".underscore").attr('disabled', false);
                $(".paycheck").prop('disabled', true);
                $("#paidtotal").val( parseFloat(purchase).toFixed(2));
                }

        });

            // $('.approval').each(function(){
            //     if($(this).is(':checked')){
            //         stren.push($(this).val());
            //     }else{
            //         stren.push(0);
            //     }

            // });
            // console.log(stren)

        ;
    });
</script>
@endsection
