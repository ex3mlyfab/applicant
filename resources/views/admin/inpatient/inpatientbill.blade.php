@extends('admin.admin')

@section('title')
    Invoice
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection


@section('content')
    <div class="content content-boxed">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title"> {{ $inpatient->user->folder_number}} - Bill update</h3>
                <div class="block-option">
                    <a href="{{route('inpatient.index')}}" class="btn btn-success">
                        <i class="fa fa-door-open"></i> Admission List
                    </a>
                    <button type="button" data-target="#service-block-normal" data-toggle="modal">Update Charges</button>
                </div>
            </div>
            <div class="block-content">
                <div class="p-sm-4 px-xl-7">
                    {{-- <div class="text-center">
                        <img src="{{asset('backend')}}/images/pentacare.png" alt="" class="img-fluid img-avatar-rounded">
                        <address>
                            Behind Fate L.G.E.A School, Mororanti Tolani Street
                            Ilorin,<br>
                            Kwara State<br>
                            cc@pentacare.com
                        </address>
                    </div> --}}
                    <!-- Invoice Info -->
                    <div class="row">
                        <div class="col-md-12">
                       <div class="block block-fx-pop">
                            <div class="block-header bg-info-dark"></div>
                            <div class="block-content ">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                         <img src="{{asset('backend')}}/images/avatar/{{$inpatient->user->avatar}}" alt="" class="img-avatar img-avatar96">
                                    </div>
                                    <div class="col-md-8 font-size-sm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="my-0"> Name:&nbsp;<strong>{{$inpatient->user->full_name}}</strong></p>
                                                <p class="mb-0">F/No:&nbsp; <strong> {{$inpatient->user->folder_number}}</strong></p>
                                                <p class="mb-0">Sex:&nbsp;{{$inpatient->user->sex}}</p>
                                                <p class="mb-0">Age:&nbsp; {{$inpatient->user->age}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="my-0"> Date of Admission:&nbsp;<strong>{{ \Carbon\Carbon::parse($inpatient->date_of_admission)->format('d/M/Y')}}</strong></p>
                                                <p class="mb-0 text-info">Number of days on admission:&nbsp; <strong> {{$days}}</strong></p>
                                                @if ($inpatient->dischargeSummaries->count())
                                               <span class="badge badge-pill p-2 badge-danger">
                                                Recommended for discharge
                                               </span>
                                            @endif
                                            </div>
                                        </div>

                                    <p>Ward: &nbsp; {{$inpatient->bed->wardModel->name}} -Bed-{{$inpatient->bed->id}}</p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right font-size-sm">
                            <p class="h3">Date: &nbsp;{{$inpatient->created_at->format('d/M/Y')}}</p>

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
                                    <th class="text-right" style="width: 180px;">Amount</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($inpatient->inpatientBill->inpatientBillDetails as $item)

                                        <tr id="{{$loop->iteration}}">
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <input type="text" name="service[]"  class="form-control" value="{{ $item->service}}" disabled>
                                                <input type="hidden" name="patient_bill_item_id[]" value="{{$item->id}}">
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            ₦
                                                        </span>
                                                    </div>
                                                    <input type="number"  name="amount[]" id="description" class="form-control"  value="{{ $item->amount }}" disabled>

                                                </div>
                                            </td>

                                        </tr>


                                @endforeach
                                @if ($inpatient->invoice->invoiceItems->count() > 1)
                                    <tr>
                                        <td colspan="3">
                                            <h3 class="text-center">Payment History</h3>
                                        </td>
                                    </tr>
                                    @foreach ($inpatient->invoice->invoiceItems as $item)
                                        @if (!($loop->first))
                                            @if ($item->item_description != 'Balance')
                                                <tr>
                                                    <td>
                                                        {{$inpatient->inpatientBill->inpatientBillDetails->count() + $loop->index }}
                                                    </td>
                                                    <td>
                                                        {{$item->item_description}}
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    ₦
                                                                </span>
                                                            </div>
                                                            <input type="number"  name="amount[]" id="description" class="form-control"  value="{{ $item->amount }}" readonly>

                                                        </div>
                                                    </td>

                                                </tr>
                                            @endif

                                        @endif
                                    @endforeach
                                @endif

                                <tr class="bg-primary text-white">
                                    <td colspan="2" class="text-right">
                                        <h3 class="text-white"> Outstanding Bill</h3>

                                    </td>
                                    <td class="text-right">
                                        <h3 class="text-white">
                                            ₦ {{
                                                number_format(($inpatient->inpatientBill->inpatientBillDetails->filter(function($item){
                                                    return $item->service != 'Initial Bill';
                                                })->sum('amount')
                                                -$inpatient->inpatientBill->inpatientBillDetails->filter(function($item){
                                                    return $item->service == 'Initial Bill';
                                                })->sum('amount') + $inpatient->invoice->invoiceItems->filter(function($item){
                                                    return strpos($item->item_description, 'Part-payment');
                                                })->sum('amount')), 2,'.', ',')

                                            }}
                                        </h3>

                                    </td>
                                </tr>








                                    </tbody>
                                </table>
                            </div>
 <form action="{{route('updateinvoice', $inpatient->id)}}" method="post" id="payment-form" >
                @csrf
                @if ($inpatient->dischargeSummaries->count())
                    <div class="form-group">
                    <input type="checkbox" class="form-check confirm" id="example-cb-custom-circle-lg1" name="confirm_discharge">
                    <label for="example-cb-custom-circle-lg1">Confirm Discharge</label>
                    </div>
                @endif


                <button type="submit" class="btn btn-primary underscore" >Update Invoice</button>

            </form>

                    <!-- END Table -->


                    <!-- END Footer -->
                </div>
            </div>

        </div>
    </div>
    <div class="modal" id="service-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title">Fluid Intake / Output Record</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                 <img src="{{asset('backend')}}/images/avatar/{{$inpatient->user->avatar}}" alt="" class="img-avatar img-avatar96">
                            </div>
                            <div class="col-md-8 font-size-sm">
                                 <p class="my-0"> Name:&nbsp;<strong>{{$inpatient->user->full_name}}</strong></p>
                                <p class="mb-0">F/No:&nbsp; <strong> {{$inpatient->user->folder_number}}</strong></p>
                                <p class="mb-0">Sex:&nbsp;{{$inpatient->user->sex}}</p>
                                <p>Age:&nbsp; {{$inpatient->user->age}}</p>

                            </div>
                        </div>
                        <h3 class="text-center text-uppercase">Update Patient Bill</h3>
                        <div class="bg-modern-lighter border rounded p-2">
                        <form action="{{route('addbill', $inpatient->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="inpatient_id" value="{{$inpatient->id}}">
                            <div class="form-row" id="scroll-fluid">
                                <div class="form-group col-md-6">
                                    <label for="select-fluid">Select Service Type</label>
                                    <select class="js-select2 form-control form-control-lg" id="select-fluid" name="service_select" style="width: 100%;" data-placeholder="Choose one..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="External Consultant">External Consultant</option>
                                        <option value="Surgeon Charge">Surgeon Charge</option>
                                        <option value="Anesthesia Charge">Anesthesia Charge</option>
                                        <option value="POP">POP</option>
                                        <option value="Dressing">Dressing</option>
                                        <option value="Physiotherapy">Physiotherapy</option>
                                        <option value="X-Ray">X-Ray</option>
                                        <option value="Laboratory">Laboratory</option>
                                        <option value="Miscallenous">Miscallenous</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control form-control-lg" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-lg btn-outline-success">Save</button>
                            </div>
                        </form>
                        </div>


                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot_js')

    <script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
    <script>jQuery(function(){ One.helpers(['select2']); });</script>



@endsection
