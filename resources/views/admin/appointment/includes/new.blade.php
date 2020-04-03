<form action="{{route('clinicalappointment.store')}}" method="post" autocomplete="off">
    @csrf
    <div class="form-group form-row">
        <div class="col-md-4">
            <label for="patient_id"> Patient Name</label>
            <select name="patient_id" id="patient_id" class="js-select2 form-control form-control-lg" style="width: 100%;" data-placeholder="Choose one.." >
                <option></option>
                @foreach ($patients as $item)
                   <option value="{{$item->id}}">{{$item->full_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <span id="space">

            </span>
        </div>
        <div class="col-md-2">
            <label for="folder_number">folder number</label>
            <input type="text" name="folder_number" id="folder_number" class="form-control form-control-lg" readonly>


        </div>
        <div class="col-md-2">
            <label for="sex">Sex</label>
            <input type="text" name="sex" id="sex" class="form-control form-control-lg" readonly>


        </div>

    </div>
    <div class="form-group form-row">
        <div class="col-md-4">
            <label for="see">To See</label>
            <input type="text" name="to_see" id="see" class="form-control form-control-lg">
        </div>
        <div class="col-md-4">
            <label for="appointment_due">Consultation Due</label>
            <input type="text" name="appointment_due" id="appointment_due" class="js-datepicker form-control form-control-lg" data-week-start="1" data-autoclose="true" data-startDate="today" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd">
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
                @endif value="paid">
                <label class="custom-control-label font-w400" for="login-remember"> Paid</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="login-remember1" name="paid" @if (old('payment')=='deffered')
                    selected
                @endif value="deffered">
                <label class="custom-control-label font-w400" for="login-remember1">Defer Payment</label>
            </div>
        </div>


    <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
</form>