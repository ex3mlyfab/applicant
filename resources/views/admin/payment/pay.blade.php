@extends('admin.admin')

@section('title')
    Invoice
@endsection


@section('content')
    <div class="content content-boxed">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title"> {{ $invoice->invoice_no}}</h3>
            </div>
            <div class="block-content">
                <div class="p-sm-4 p-xl-7">
                    <div class="text-center">
                    <img src="{{asset('backend')}}/images/pentacare.png" alt="" class="img-fluid img-avatar-rounded">
                    <address>
                        Behind Fate L.G.E.A School, Mororanti Tolani Street
                        Ilorin,<br>
                        Kwara State<br>
                        cc@pentacare.com
                    </address>
                    </div>
                    <!-- Invoice Info -->
                    <div class="row mb-4">
                        {{-- <!-- Company Info -->
                        <div class="col-6 font-size-sm">
                            <p class="h3">Pentacare Hospital</p>

                        </div>
                        <!-- END Company Info --> --}}

                        <!-- Client Info -->
                        <div class="col-6 font-size-sm">
                            <p class="h3">{{$invoice->billing}}</p>
                            <address>

                            </address>
                        </div>
                        <div class="col-6 text-right font-size-sm">
                            <p class="h3">{{$invoice->created_at->format('d/M/Y')}}</p>
                            <address>

                            </address>
                        </div>
                        <!-- END Client Info -->
                    </div>
                    <!-- END Invoice Info  -->

                    <!-- Table -->
                    <div class="table-responsive push">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;"></th>
                                    <th>Service</th>
                                    <th class="text-center" style="width: 90px;">pay</th>
                                    <th class="text-right" style="width: 180px;">Amount</th>
                                </tr>
                            </thead>
                        <form action="{{($invoice->invoiceable_type == 'App\Models\Pharmreq')?
                            route('payment.pharmacy'):
                            route('payment.pay')
                        }}" method="post" id="payment-form" >
                            @csrf
                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

                            <tbody>

                                @foreach ($invoice->invoiceItems as $item)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                            <input type="text" @if ($item->status== 'NYP') name="service[]" @endif class="form-control" value="{{ $item->item_description}}" readonly>
                                            @if ($item->status== 'NYP') <input type="hidden" name="invoice_item_id[]" value="{{$item->id}}"> @endif
                                            </td>

                                            <td>
                                                @if ($item->status== 'NYP')
                                            <input type="checkbox" name="pay[]" class="form-control form-check paycheck" value="{{$item->id}}" data-amount="{{$item->amount}}" >@endif


                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            ₦
                                                        </span>
                                                    </div>
                                                    <input type="number" @if ($item->status== 'NYP') name="amount[]" @endif id="description" class="form-control"  value="{{$item->amount}}" readonly>

                                                </div>
                                            </td>

                                        </tr>


                                @endforeach

                                <tr>

                                    <td colspan="3" class="font-w600 text-right">Total Balance</td>
                                    <td class="text-right totaldue">₦{{ $invoice->invoiceItems->reduce(function($carry,$item){
                                        if($item->status=='NYP'){
                                            return $carry + $item->amount;
                                        }
                                    })}}</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="font-w700 text-uppercase text-right bg-body-light">Total Paid</td>
                                    <td class="font-w700 text-right bg-body-light totalpaid">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ₦
                                                </span>
                                            </div>
                                            <input type="number" name="totalpaid" id="paidtotal" class="form-control text-right"   readonly>

                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" id="part_payment_wrapper">
                        <div class="form-group col-md-6">
                            <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg custom-control-secondary mb-1">
                            <input type="checkbox" class="custom-control-input" id="part_payment" name="part_payment">
                            <label class="custom-control-label" for="part_payment">Make Part-Payment</label>
                    </div>
                        </div>
                        <div class="form-group col-md-6" id="part_pay_amount">
                            <label for="part_amount">amount paid</label>
                            <input type="number" name="part_amount" id="part_amount" class="form-control form-control-lg" max="{{ $invoice->invoiceItems->reduce(function($carry,$item){
                                if($item->status=='NYP'){
                                    return $carry + $item->amount;
                                }
                            })}}">
                        </div>
                    </div>

                    @if (isset($invoice->user_id))
                    <input type="hidden" name="user_id" value="{{$invoice->user_id}}">
                    <input type="hidden" name="invoice_no" value={{ $invoice->invoice_no}}>
                    <input type="hidden" name="payment_method" value="{{$invoice->user->payment_method}}" >
                    <input type="hidden" name="invoice_type" value="{{$invoice->invoiceable_type}}" >
                    <input type="hidden" name="invoice_type_id" value="{{$invoice->invoiceable_id}}" >

                    @else
                    <input type="hidden" name="name" value="{{$invoice->name}}">

                    @endif
                    <input type="hidden" name="pay_control" id="pay-control">
                    <div class="row">
                            @include('admin.paymentmode2')
                        <div class="col-md-6 offset-col-md-1  bg-amethyst rounded" id="payment-mode">
                             @include('admin.paymentmode')
                        </div>
                        <div class="col-md-6" id="mixed-pay">
                            <div class="form-group">
                                <label for="cash_amount">cash amount</label>
                                <input type="number" name="cash_amount" id="cash_amount" class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                                <label for="bank_amount">bank amount</label>
                                <input type="number" name="bank_amount" id="bank_amount" class="form-control form-control-lg">
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-4" id="payment-status">
                        <div class="form-check">
                            <input type="checkbox" class="form-check confirm" id="example-cb-custom-circle-lg1" name="example-cb-custom-circle-lg1">
                            <label for="example-cb-custom-circle-lg1">Confirm Payment</label>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary underscore" disabled>Make Payment</button>

                </form>
                    <!-- END Table -->


                    <!-- END Footer -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot_js')

<script>
    $(function(){
            var totalpaid = 0;
        let payment_mode =  $('input[name=payment_method]').val();
            if((payment_mode=='insured'|| payment_mode == 'mdaccount')){
                $(".paycheck").prop({checked:true,
                disabled: true});
                $('#part_payment_wrapper').hide();
            }

        $("#mixed-pay").hide();
        $('#cash_amount').prop({disabled : true, required : false});
        $('#bank_amount').prop({disabled : true, required : false});

        $('#part_paymnet').click(function(){
            if(this.checked){
                $('#part_ammount').prop( 'required', true);

            }else{
                $('#part_ammount').prop('required', false);

            }
        });

        $(".confirm").change(function(){
            if(this.checked){
                let total = [];
                let paycontrol = [];
                $(".paycheck").each(function(){
                    if($(this).is(':checked')){
                        total.push(parseFloat($(this).data("amount")));
                        paycontrol.push(parseFloat($(this).val()));
                    }
                 });
                 let purchase = (Array.isArray(total) && total.length) ? total.reduce((total, amount) => total + amount, 0) : 0 ;
                $('#totalBalance').val(parseFloat(purchase).toFixed(2));
                if(purchase != 0){
                $('#pay-control').val(paycontrol);
                ($('#part_payment').is(':checked') && parseFloat($('#part_amount').val()) <= 0) ? $(".underscore").attr('disabled', true): $(".underscore").attr('disabled', false);
                $(".paycheck").prop('disabled', true);
                    let showAmount =$('#part_payment').is(':checked') ? parseFloat($('#part_amount').val()).toFixed(2) : parseFloat(purchase).toFixed(2);

                $("#paidtotal").val(showAmount);
                }

            }else{
                let total = [];
                $(".paycheck").each(function(){
                    if($(this).is(':checked')){
                        total.push(parseFloat($(this).data("amount")));
                    }
                 });
                 let purchase = (Array.isArray(total) && total.length) ? total.reduce((total, amount) => total + amount, 0) : 0 ;
                $(".underscore").attr('disabled', true);
                $(".paycheck").prop('disabled', false);
                $("#paidtotal").val( parseFloat(purchase).toFixed(2));
            }
        });
        $('#part_pay_amount').hide().prop('disabled', true);
        $('#part_payment').click(function(){
                if($(this).is(':checked')){
                   $('#part_pay_amount').show();
                   $('#part_amount').prop( 'required', true);
                   $(".paycheck").prop({checked:true,
                disabled: true});

                }else{
                    $('#part_pay_amount').hide();
                    $(".paycheck").prop({checked:false,
                disabled: false});
                    $('#part_amount').prop( 'required', false);

                }
        });
        $('#payment-mode').hide();
        $('.bank-check').prop('disabled', true);

        $('.payment-option').bind('click',function(){
            let identity = $(this);
            if(identity.is(':checked')){

                if(identity.prop('id')== 'pos-2'|| identity.prop('id') == 'pos-3'){
                    $('#payment-mode').show();
                    $('.bank-check').prop('disabled', false);
                    $('#payment-status').show();
                    $(".underscore").attr('disabled', true);
                    $("#mixed-pay").hide();
                    $('#cash_amount').prop({disabled : true, required : false});
                    $('#bank_amount').prop({disabled : true, required : false});
                }else if(identity.prop('id') == 'pos-4'){
                    $('#payment-status').hide();
                    $('.bank-check').prop('disabled', true);
                    $('#payment-mode').hide();
                    $(".underscore").attr('disabled',false);
                    $("#mixed-pay").hide();
                    $('#cash_amount').prop({disabled : true, required : false});
                    $('#bank_amount').prop({disabled : true, required : false});
                } else if(identity.prop('id') == 'pos-7'|| identity.prop('id') == 'pos-8'){
                    $('#payment-mode').show();
                    $('.bank-check').prop('disabled', false);
                    $('#payment-status').show();
                    $(".underscore").attr('disabled', true);
                    $("#mixed-pay").show();
                    $('#cash_amount').prop({disabled : false, required : true});
                    $('#bank_amount').prop({disabled : false, required : true});
                }
                else{
                    $('#payment-mode').hide();
                    $('.bank-check').prop('disabled', true);
                    $('#payment-status').show();
                    $(".underscore").attr('disabled', true);
                    $("#mixed-pay").hide();
                    $('#cash_amount').prop({disabled : true, required : false});
                    $('#bank_amount').prop({disabled : true, required : false});
                }
            }

        });



    });
</script>

@endsection
