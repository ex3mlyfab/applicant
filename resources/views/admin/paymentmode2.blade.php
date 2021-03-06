    @php
    $paymentmode = \App\Models\PaymentMode::all()->filter(function($item){
        return $item->name != 'MD-account';
    })
    @endphp
    <div class="form-group">
        <label class="d-block">Payment Mode</label>
    @foreach ($paymentmode as $item)
        <div class="custom-control custom-radio custom-control-primary custom-control-inline custom-control-lg" id="wrapper{{$item->id}}">

            <input type="radio" name="payment_mode" style="height:25px; width:25px;" id="pos-{{$item->id}}" class="form-check-input payment-option" value="{{$item->id}}" required>
            <label style="font-size: 18px" for="pos-{{$item->id}}" class="form-check-label font-weight-normal ml-3 mt-1">{{$item->name}}</label>
        </div>


    @endforeach
    </div>
