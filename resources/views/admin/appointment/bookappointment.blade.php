@extends('admin.admin')
@section('title')
    Book Consultation
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="block pentacare-bg">
            <div class="block-header">
                <h3 class="block-title"></h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('clinicalappointment.store')}}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-4">
                            <label for="patient"> Patient Name</label>
                            <input type="text" name="name" id="patient" class="form-control form-control-lg" value="{{$patient->full_name}}" disabled>
                        <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}">
                        </div>
                        <div class="col-md-4">

                            <img src="{{ asset('backend')}}/images/avatar/{{$patient->avatar}}" class="img img-rounded" alt="{{$patient->full_name}}" style="max-width: 100%;">

                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="folder_number">folder number</label>
                                <input type="text" name="folder_number" id="folder_number" class="form-control form-control-lg" value="{{$patient->folder_number}}" disabled>


                                </div>
                                <div class="col-md-12">
                                    <label for="sex">Sex</label>
                                <input type="text" name="sex" id="sex" class="form-control form-control-lg" value="{{$patient->sex}}" disabled>


                                </div>
                                <div class="col-md-12">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-lg" value="{{$patient->phone}}" disabled>
                                   {{-- <h4>{{
                                        ( $patient->clinicalAppointments->count() && $patient->day_agos_appointment < 30)
                                    }}
                                    </h4> --}}

                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-4">
                            <label for="see">To See</label>
                            <input type="text" name="to_see" id="see" class="form-control form-control-lg">
                        </div>
                        @if ($message)
                            <div class="col-md-4 offset-md-2">
                            <h3>{{ $message}}</h3>
                            </div>
                        @endif
                    </div>
                    @if (!($patient->clinicalAppointments->count() && $patient->day_agos_appointment < 30))
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="charge">Charges</label>
                                <input type="hidden" name="original_charge" value="{{$charge->amount}}" >
                                <input type="text" name="charges" id="charge" class="form-control form-control-lg" value="{{$due_payment}}" readonly>
                                <input type="hidden" name="coverage" value="{{$percentage}}">
                            </div>

                            @if ($percentage < 100)
                                @if ($patient->payment_method != 'insured')
                                @include('admin.paymentmode2')
                                    <div class="form-group col-md-4 bg-amethyst-lighter block block-rounded" id="payment-mode">
                                            @include('admin.paymentmode')
                                    </div>
                                    <div class="form-group col-md-6 mt-2" id="payment-status">
                                            <label class="d-block" style="font-size: 20px">Payment Status</label>
                                            <div class="form-check mt-3">
                                                <input type="checkbox" name="payment" id="paid" class="form-check-inline" style="height:15px; width:15px;" required>
                                                <label for="paid" class="form-check-label font-weight-normal" style="font-size: 18px">Paid</label>
                                        </div>
                                    </div>

                                @endif
                            @endif

                        </div>


                    @endif




                    <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('foot_js')
   <script>
    $(function(){
        $('#payment-mode').hide();
        $('.bank-check').prop('disabled', true);
        $('.payment-option').bind('click',function(){
            let identity = $(this);

            if(identity.is(':checked')){
                if(identity.prop('id')== 'pos-2'|| identity.prop('id') == 'pos-3'){
                    $('#payment-mode').show();
                    $('.bank-check').prop('disabled', false);
                    $('#payment-status').show();
                    $('#paid').prop('disabled', false);
                }else if(identity.prop('id') == 'pos-4'){
                    $('#payment-status').hide();
                    $('.bank-check').prop('disabled', true);
                    $('#payment-mode').hide();
                    $('#paid').prop('disabled', true);
                }else{
                    $('#payment-mode').hide();
                    $('.bank-check').prop('disabled', true);
                    $('#payment-status').show();
                    $('#paid').prop('disabled', false);
                }
            }

        });
    });
    </script>
@endsection
