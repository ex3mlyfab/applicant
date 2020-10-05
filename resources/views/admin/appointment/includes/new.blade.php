<form action="{{route('clinicalappointment.store')}}" method="post" autocomplete="off">
    @csrf
    <div class="form-group form-row">
        <div class="col-md-4">
            <label for="patient_id"> Patient Name</label>
            <input type="text" name="name" id="patient_id" class="form-control form-control-lg">
            <input type="hidden" name="patient_id">
        </div>
        <div class="col-md-4">
            <span id="space">

            </span>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="folder_number">folder number</label>
                    <input type="text" name="folder_number" id="folder_number" class="form-control form-control-lg" readonly>


                </div>
                <div class="col-md-12">
                    <label for="sex">Sex</label>
                    <input type="text" name="sex" id="sex" class="form-control form-control-lg" readonly>


                </div>
                <div class="col-md-12">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control form-control-lg" readonly>


                </div>
            </div>
        </div>


    </div>
    <div class="form-group form-row">
        <div class="col-md-4">
            <label for="see">To See</label>
            <input type="text" name="to_see" id="see" class="form-control form-control-lg">
        </div>
        <div class="col-md-4">
            <label for="appointment_due">Consultation Due</label>
            <input type="text" name="appointment_due" id="appointment_due" class="js-datepicker form-control form-control-lg" data-week-start="1" data-autoclose="true" data-startDate="today" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" >
        </div>
        <div class="col-md-4">
            <label for="">Charges</label>
            <input type="text" name="charges" id="" class="form-control form-control-lg" value="{{$charge->amount}}" readonly>
        </div>
    </div>
        <div class="form-group">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="login-remember" name="payment" @if (old('payment')=='paid')
                    selected
                @endif value="paid" required>
                <label class="custom-control-label font-w400" for="login-remember"> Paid</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="login-remember1" name="payment" @if (old('payment')=='deffered')
                    selected
                @endif value="deffered" required>
                <label class="custom-control-label font-w400" for="login-remember1">Defer Payment</label>
            </div>
        </div>


    <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
</form>
