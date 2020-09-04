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
                                    <th class="text-center" style="width: 90px;">pay</th>
                                    <th class="text-right" style="width: 120px;">Amount</th>
                                </tr>
                            </thead>
                            <form action="" method="post">
                            <tbody>
                                @foreach ($invoice->invoiceItems as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <input type="text" name="service[]" class="form-control" value="{{ $item->item_description}}" readonly>
                                        </td>

                                        <td>
                                            <input type="checkbox" name="pay[]" class="form-control form-check">
                                        </td>
                                        <td>
                                            <input type="text" name="amount[]" class="form-control" value="{{ $item->amount}}" readonly>
                                        </td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4" class="font-w600 text-right">Total Due</td>
                                    <td class="text-right totaldue"></td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="font-w700 text-uppercase text-right bg-body-light">Total Paid</td>
                                    <td class="font-w700 text-right bg-body-light totalpaid"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (isset($invoice->user_id))
                    <input type="hidden" name="user_id" value="{{$invoice->user_id}}">
                    @else
                    <input type="hidden" name="name" value="{{$invoice->name}}">
                    @endif

                </form>
                    <!-- END Table -->

                    <!-- Footer -->
                    <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
                        Thank you very much for doing business with us. We look forward to working with you again!
                    </p>
                    <!-- END Footer -->
                </div>
            </div>
        </div>
    </div>
@endsection
