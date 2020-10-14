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


                        }}" method="post" id="payment">
                            @csrf
                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

                            <tbody>

                                @foreach ($invoice->invoiceItems as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                        <input type="text" name="service[]" class="form-control" value="{{ $item->item_description}}" readonly>
                                        <input type="hidden" name="invoice_item_id[]" value="{{$item->id}}">
                                        </td>

                                        <td>
                                            @if (!(($invoice->user->payment_method == 'mdaccount')||($invoice->user->payment_method == 'insured')))
                                        <input type="checkbox" name="pay[]" class="form-control form-check paycheck" value="{{$item->id}}" data-amount="{{$item->amount}}" >
                                            @endif

                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ₦
                                                    </span>
                                                </div>
                                                <input type="number" name="amount[]" id="description" class="form-control"  value="{{$item->amount}}" readonly>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3" class="font-w600 text-right">Total Balance</td>
                                    <td class="text-right totaldue">₦{{$invoice->total_amount }}</td>
                                </tr>
                                @if (($invoice->user->payment_method == 'mdaccount')||($invoice->user->payment_method == 'insured'))
                                <tr>

                                    <td colspan="3" class="font-w600 text-right">Due Amount
                                    <p>{{$message}}</p>
                                    </td>
                                    <td class="text-right totaldue">₦{{ $due_payment}}</td>
                                </tr>

                                @endif
                                <tr>
                                    <td colspan="3" class="font-w700 text-uppercase text-right bg-body-light">Total Paid</td>
                                    <td class="font-w700 text-right bg-body-light totalpaid"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (isset($invoice->user_id))
                    <input type="hidden" name="user_id" value="{{$invoice->user_id}}">
                    <input type="hidden" name="invoice_no" value={{ $invoice->invoice_no}}>
                    <input type="hidden" name="payment_method" value="{{$invoice->user->payment_method}}" >
                    <input type="hidden" name="due_payment" value="{{$due_payment}}">




                    @else
                    <input type="hidden" name="name" value="{{$invoice->name}}">

                    @endif
                    <div class="row">
                            @include('admin.paymentmode2')
                        <div class="col-md-6 offset-col-md-1  bg-amethyst rounded" id="payment-mode">
                             @include('admin.paymentmode')
                        </div>

                    </div>

                    <div class="form-group" id="payment-status">
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
    if(!(payment_mode=='insured'|| payment_mode == 'mdaccount'))
    {
         $(".paycheck").bind('change', function(){
            if(this.checked){
                totalpaid +=  parseInt($(this).data("amount"));
            }else{
                totalpaid -= parseInt( $(this).data("amount"));
            }
        });
    }else{
        totalpaid = {{$due_payment}};
    }

        $(".confirm").change(function(){
            if(this.checked){
                if(totalpaid != 0)
                $(".underscore").attr('disabled', false);
                $(".totalpaid").html( "₦" + totalpaid);
            }else{
                $(".underscore").attr('disabled', true);
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
                }else if(identity.prop('id') == 'pos-4'){
                    $('#payment-status').hide();
                    $('.bank-check').prop('disabled', true);
                    $('#payment-mode').hide();
                }else{
                    $('#payment-mode').hide();
                    $('.bank-check').prop('disabled', true);
                    $('#payment-status').show();
                }
            }

        });



    });
</script>

@endsection
