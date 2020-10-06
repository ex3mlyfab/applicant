@php
    $banks = \App\Models\Bank::all();
@endphp
<div class="p-2">
    <label class="d-block" style="font-size: 20px">Select Bank</label><br>
    @foreach ($banks as $item)
        <div class="form-check mt-1">
            <input type="radio" name="transfer_id" style="height:25px; width:25px;" id="trans-{{$loop->iteration}}" class="form-check-input bank-check" value="{{$item->id}}" required>
            <label style="font-size: 18px" for="trans-{{$loop->iteration}}" class="form-check-label font-weight-normal ml-3 mt-1">{{$item->name.'/'. $item->account_name}}<br>{{$item->account_number}}</label>
        </div>

    @endforeach
</div>

