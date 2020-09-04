@extends('admin.admin')

@section('title')
    prepare invoice
@endsection
@section('content')
    <div class="content">
        <div class="block block-fx-pop">
            <div class="block-header bg-warning">
                <h3 class="block-title">
                    invoice for {{ $item->clinicalAppointment->user->full_name }}
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="block-header bg-info-dark"></div>
                <div class="block-content ">
                    <div class="row">
                        <div class="col-md-4 text-center">
                             <img src="{{asset('backend')}}/images/avatar/{{$item->clinicalAppointment->user->avatar}}" alt="" class="img-avatar img-avatar96">
                        </div>
                        <div class="col-md-8 font-size-sm">
                             <p class="my-0"> Name:&nbsp;<strong>{{$item->clinicalAppointment->user->full_name}}</strong></p>
                            <p class="mb-0">F/No:&nbsp; <strong> {{$item->clinicalAppointment->user->folder_number}}</strong></p>
                            <p class="mb-0">Sex:&nbsp;{{$item->clinicalAppointment->user->sex}}</p>
                            <p>Age:&nbsp; {{$item->clinicalAppointment->user->age}}</p>

                        </div>
                    </div>

                </div>
            <form action="{{route('haematology.prepareinvoice')}}" method="post">
                    <!--generate invoice item line-->
                    @csrf
                    <div class="form-group form-row">

                        <div class="col-md-5">

                        <label for="charge">Charge</label>

                        <input type="text" id="full_name" name="amount" class="form-control" value="{{$charge->amount}}" readonly>
                        </div>
                    <input type="hidden" name="haem_id" value="{{$item->id}}">
                    <input type="hidden" name="charge_id" value="{{$charge->id}}">
                    <input type="hidden" name="user_id" value="{{$item->clinicalAppointment->user->id}}">
                        <div class="col-md-7">
                            <label for="folder_number">for</label>
                        <input type="text" id="folder_number" name="item_description" class="form-control" value="{{$item->investigation_required}}" readonly>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary w-100">Generate Invoice</button>
                </form>
            </div>
        </div>
    </div>
@endsection
