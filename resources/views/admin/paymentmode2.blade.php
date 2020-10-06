    @php
    $paymentmode = \App\Models\PaymentMode::all()->filter(function($item){
        return $item->name != 'MD-account';
    })
    @endphp
    <div class="form-group col-md-4">
        <label>Payment Mode</label>
    @foreach ($paymentmode as $item)

        <div class="form-check mt-1">
            <input type="radio" name="payment_mode" style="height:25px; width:25px;" id="pos-{{$loop->iteration}}" class="form-check-input payment-option" value="{{$item->id}}" required>
            <label style="font-size: 18px" for="pos-{{$loop->iteration}}" class="form-check-label font-weight-normal ml-3 mt-1">{{$item->name}}</label>
        </div>


    @endforeach
    </div>
