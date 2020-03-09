@extends('admin.admin')

@section('title')
    Add company
@endsection
@section('content')
<div class="content">
    <div class="block block-fx-shadow">
        <div class="block-header bg-modern-dark text-center">
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
                            <label class="d-block">Registration Type</label>

                            @foreach ($companies as $item)
                                <div class="form-check">
                                <input class="form-check-input regtype" type="radio" id="example-radios-inline{{$item->id}}" name="registration_type_id" value="{{$item->id}}" required>
                                    <label class="form-check-label" for="example-radios-inline{{$item->id}}">{{$item->name}} | &nbsp; <span class="text-info"> Charge: {{ $item->charge->amount }}</span></label>
                                </div>

                            @endforeach

                        </div>
                        <div class="form-group">
                            <label for="organisation_name">Company Name</label>
                            <input type="text" name="organisation_name" id="organisation_name" class="form-control form-control-lg" >
                        </div>
                        <div class="form-group">
                            <label for="organisation_address">Company address</label>
                            <textarea name="address" id="organisation_address"  rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="organisation_phone">Company Phone</label>
                            <input type="text" name="contact_phone" id="organisation_phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="paid" id="paid" class="form-check-inline" required>
                            <label for="paid" class="form-check-label">Paid</label>
                        </div>
                        <button type="submit" class="btn btn-block btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
