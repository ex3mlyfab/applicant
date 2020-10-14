@extends('admin.admin')

@section('title')
    Add company
@endsection
@section('content')
<div class="content">
    <div class="block block-fx-shadow pentacare-bg">
        <div class="block-header text-center " style="background: rgb(51, 70, 128, 0.6);">
            <h3 class="block-title text-white">
                Add New company
            </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <form action="{{ route('company.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="d-block" style="font-size: 20px">Registration Type</label>

                            @foreach ($companies as $item)
                                <div class="form-check mb-3">
                                <input class="form-check-input regtype" type="radio" id="example-radios-inline{{$item->id}}" name="registration_type_id" value="{{$item->id}}" required>
                                    <label class="form-check-label font-weight-normal" for="example-radios-inline{{$item->id}}">{{$item->name}} | &nbsp; <span class="text-info"> Charge: {{ $item->charge->amount }}</span></label>
                                </div>

                            @endforeach

                        </div>
                        <div class="form-group mt-3">
                            <label for="organisation_name">Company Name</label>
                            <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="organisation_name" id="organisation_name" class="form-control form-control-lg" >
                        </div>
                        <div class="form-group">
                            <label for="organisation_address">Company address</label>
                            <textarea name="address" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" id="organisation_address"  rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="organisation_phone">Company Phone</label>
                            <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" name="contact_phone" id="organisation_phone" class="form-control">
                        </div>
                        <div class="form-row">
                                @include('admin.paymentmode2')
                            <div class="form-group col-md-6 bg-amethyst-lighter block block-rounded" id="payment-mode">
                                @include('admin.paymentmode')
                            </div>
                        </div>

                        <div class="form-group mt-2">

                            <label class="d-block" style="font-size: 16px">Payment Status</label>
                            <input type="checkbox" name="paid" id="paid" class="form-check-inline" required>
                            <label for="paid" class="form-check-label">Paid</label>
                        </div>
                        <button type="submit" style="background: rgb(51, 70, 128)" class="btn btn-block btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('foot_js')
    <script>
         $('#payment-mode').hide();
        $('.bank-check').prop('disabled', true);
        $('#pos-4').hide();
        $('label[for=pos-4]').hide();
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
    </script>
@endsection
