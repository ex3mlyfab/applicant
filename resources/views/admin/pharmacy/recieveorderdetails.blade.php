@extends('admin.admin')
@section('title')
    recieve order preview
@endsection

@section('content')
   <!-- Page Content -->
   <div class="content content-boxed">
    <!-- Invoice -->
    <div class="block">
        <div class="block-header">
        <h3 class="block-title">Recieved Order from {{$recieveorder->supplier->name}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Helpers.print() -->
                <button type="button" class="btn-block-option" onclick="One.helpers('print');">
                    <i class="si si-printer mr-1"></i> Print Invoice
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="p-sm-4 p-xl-7">
                <!-- Invoice Info -->
                <div class="row mb-4">
                    <!-- Company Info -->
                    <div class="col-6 font-size-sm">
                        <p class="h3">{{$recieveorder->supplier->name}}</p>
                        <address>
                            {{ $recieveorder->supplier->address }}<br>
                            {{$recieveorder->supplier->contact_phone}}
                        </address>

                    </div>
                    <!-- END Company Info -->
                    <!-- Company Info -->
                    <div class="col-6 font-size-sm text-right">
                        <p class="h5">R/NO:{{$recieveorder->receipt_no}}</p>
                        <p> {{$recieveorder->created_at->format('d-M-Y')}}</p>


                    </div>
                    <!-- END Company Info -->



                </div>
                <!-- END Invoice Info -->

                <!-- Table -->
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 90px;">Qty</th>
                                <th class="text-right" style="width: 120px;">Unit</th>
                                <th class="text-right" style="width: 120px;">Amount(₦)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recieveorder->recieveOrderDetails as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <p class="font-w600 mb-1">{{ $item->drugModel->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-primary">{{ $item->quantity_needed }}</span>
                                    </td>
                                    <td class="text-right">
                                        {{ $item->price}}
                                    </td>
                                    <td class="text-right">{{number_format($item->quantity_needed * $item->price, 2, '.', ',')}}</td>

                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="4" class="text-right">
                                        <h4>Total:</h4>
                                    </td>
                                    <td>
                                        ₦ {{ number_format($recieveorder->costs, 2, '.', ',')}}
                                    </td>
                                </tr>
                        </tbody>
                    </table>

                </div>
                <!-- END Table -->
                <div class="row">

                    <div class="col-6 font-size-sm">
                        <p class="h5">payment mode: {{$recieveorder->payment_status}}</p>
                    </div>
                    <div class="col-6 font-size-sm text-right">
                        <p class="h5">checked by: {{$recieveorder->admin->name}}</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- END Page Content -->
@endsection
