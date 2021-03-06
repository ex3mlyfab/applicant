@extends('admin.admin')

@section('title')
    Invoice
@endsection


@section('content')
    <div class="content content-boxed">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title"> {{ $invoice->invoice_no}}</h3>
                <div class="block-options">
                    <!-- Print Page functionality is initialized in Helpers.print() -->
                    <button type="button" class="btn-block-option" onclick="One.helpers('print');">
                        <i class="si si-printer mr-1"></i> Print Invoice
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="p-sm-4 p-xl-7">
                    <div class="text-center">
                    <img src="{{asset('backend')}}/images/pentacare.png" alt="" class="img-fluid img-avatar-rounded">
                    </div>
                    <!-- Invoice Info -->
                    <div class="row mb-4">
                        <!-- Company Info -->
                        <div class="col-6 font-size-sm">
                            <p class="h3">Pentacare Hospital</p>
                            <address>
                                Ilorin,<br>
                                Kwara State<br>
                                cc@pentacare.com
                            </address>
                        </div>
                        <!-- END Company Info -->

                        <!-- Client Info -->
                        <div class="col-6 text-right font-size-sm">
                            <p class="h3">{{$invoice->billing}}</p>
                            <address>

                            </address>
                        </div>
                        <!-- END Client Info -->
                    </div>
                    <!-- END Invoice Info -->

                    <!-- Table -->
                    <div class="table-responsive push">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;"></th>
                                    <th>Service</th>

                                    <th class="text-right" style="width: 180px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->invoiceItems as $item)
                                    @if ($item->status == 'paid')
                                       <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <p class="font-w600 mb-1">{{$item->item_description}}</p>
                                        </td>


                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ₦
                                                    </span>
                                                </div>
                                                <input type="number"  id="description" class="form-control"  value="{{$item->amount}}" readonly>

                                            </div>
                                        </td>

                                    </tr>
                                    @endif

                                @endforeach

                                <tr>
                                    <td colspan="2" class="font-w600 text-right">Total Paid</td>
                                    <td class="text-right totaldue">₦{{$invoice->total_amount }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

<hr class="py-3">
<!-- Invoice Info -->
<h3 class="block-title text-center"> {{ $invoice->invoice_no}}</h3>
<div class="row mb-4">
    <!-- Company Info -->
    <div class="col-6 font-size-sm">
        <p class="h3">Pentacare Hospital</p>
        <address>
            Ilorin,<br>
            Kwara State<br>
            cc@pentacare.com
        </address>
    </div>
    <!-- END Company Info -->

    <!-- Client Info -->
    <div class="col-6 text-right font-size-sm">
        <p class="h3">{{$invoice->billing}}</p>
        <address>

        </address>
    </div>
    <!-- END Client Info -->
</div>
<!-- END Invoice Info -->

<!-- Table -->
<div class="table-responsive push">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center" style="width: 60px;"></th>
                <th>Service</th>

                <th class="text-right" style="width: 180px;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoiceItems as $item)
                @if ($item->status == 'paid')
                   <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <p class="font-w600 mb-1">{{$item->item_description}}</p>
                    </td>


                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    ₦
                                </span>
                            </div>
                            <input type="number"  id="description" class="form-control"  value="{{$item->amount}}" readonly>

                        </div>
                    </td>

                </tr>
                @endif

            @endforeach

            <tr>
                <td colspan="2" class="font-w600 text-right">Total Paid</td>
                <td class="text-right totaldue">₦{{$invoice->total_amount }}</td>
            </tr>


        </tbody>
    </table>
</div>


                    <!-- END Table -->


                    <!-- END Footer -->
                </div>
            </div>
        </div>
    </div>
@endsection

