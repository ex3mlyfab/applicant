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
                             <img src="{{asset('public/backend')}}/images/avatar/{{$item->clinicalAppointment->user->avatar}}" alt="" class="img-avatar img-avatar96">
                        </div>
                        <div class="col-md-8 font-size-sm">
                             <p class="my-0"> Name:&nbsp;<strong>{{$item->clinicalAppointment->user->full_name}}</strong></p>
                            <p class="mb-0">F/No:&nbsp; <strong> {{$item->clinicalAppointment->user->folder_number}}</strong></p>
                            <p class="mb-0">Sex:&nbsp;{{$item->clinicalAppointment->user->sex}}</p>
                            <p>Age:&nbsp; {{$item->clinicalAppointment->user->age}}</p>

                        </div>
                    </div>

                </div>
                <form action="" method="post">
                    <div class="form-group form-row">
                        <div class="col-md-4">

                            <label for="charge">Charge</label>

                        <input type="text" id="full_name" class="form-control" value="{{$charge->amount}}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="folder_number">for</label>
                        <input type="text" id="folder_number" class="form-control" value="{{$item->investigation_required}}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="sex">sex</label>
                            <input type="text" id="sex" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <img >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
