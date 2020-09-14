@extends('admin.admin')
@section('title')
Purchase Order details
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="block block-fx-shadow">
            <div class="block-header bg-info-light">Purchase Orders Raised on {{ date('d-M-Y') }}
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
                        <h4>total: {{ $purchaseOrder->total }}</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bodered table-striped">
                            <thead>
                                <th>SN</th>
                                <th>Drug Name</th>
                                <th>price</th>
                                <th>Quantity</th>
                                <th> Cost</th>
                                <th class="bg-secondary text-white">action</th>
                            </thead>
                            @foreach ($purchaseOrder->purchaseOrderDetails as $item)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    <input type="hidden" name="purchase_order_detail_id[]" value="{{$item->id}}">
                                    </td>
                                    <td>
                                        {{$item->drugModel->name}}
                                    </td>
                                    <td>
                                        {{$item->price}}
                                    </td>
                                    <td>
                                        {{$item->quantity_needed}}
                                    </td>
                                    <td>
                                        {{ $item->price * $item->quantity_needed  }}
                                    </td>
                                    <td class="bg-secondary text-center">
                                    <input type="checkbox" name="approved[]" value="{{$item->id}}"class="form-checkbox form-checkbox-lg approval">
                                    </td>
                                </tr>
                            @endforeach
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
