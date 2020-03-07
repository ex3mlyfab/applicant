@extends('admin.admin')

@section('title')
take vital signs

@endsection

@section('content')
<div class="content">
    <div class="block block-fx-pop">
        <div class="block-header bg-info">
            <h3 class="block-title">Take Vitals</h3>
        </div>
        <div class="block-content content-full">
            <form action="{{route('nursing.store')}}" method="post">
                @csrf
                <div class="form-group form-row">
                    <div class="col-md-4">
                    <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" >
                    </div>
                    <div class="col-md-4">
                        <label for="patient_id"> Patient Name</label>
                        <input type="text" value="{{$patient->full_name}}" class="form-control form-control-lg" readonly>
                        <input type="hidden" name="patient_id"  value="{{$patient->id}}" >
                    </div>

                    <div class="col-md-2">
                        <label for="folder_number">folder number</label>
                    <input type="text" name="folder_number" id="folder_number" value="{{$patient->folder_number}}" class="form-control form-control-lg" readonly>


                    </div>
                    <div class="col-md-2">
                        <label for="sex">Sex</label>
                    <input type="text" name="sex" id="sex" value="{{$patient->sex}}" class="form-control form-control-lg" readonly>


                    </div>

                </div>
                <div class="form-group form-row">
                    <div class="col-md-2">
                        <label for="diastolic">Blood pressure</label>

                    </div>
                    <div class="col-md-2">
                        <input type="text" name="systolic" id="sytolic" placeholder="Systolic" class="form-control form-control-lg" >
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="diastolic" id="diastolic" placeholder="diastolic" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-2">
                        <label for="temp">Temperature</label>
                        <div class="input-group">
                            <input type="text" name="temp" id="temp" class="form-control form-control-lg">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                   <sup>o</sup> C
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="rr">Respiratory Rate</label>
                        <div class="input-group">
                        <input type="text" name="rr" id="rr" placeholder="Respiratory Rate" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span class="input-group-text">
                               bpm
                            </span>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <label for="pr">Pulse Rate</label>
                        <div class="input-group">
                        <input type="text" name="pr" id="pr" placeholder="Pulse Rate" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span class="input-group-text">
                          bpm
                            </span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="height">height</label>
                        <div class="input-group">
                        <input type="text" name="height" id="height" placeholder="Height in meters" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span class="input-group-text">
                               m
                            </span>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <label for="weight">weight</label>
                        <div class="input-group">
                        <input type="text" name="weight" id="weight" placeholder="Weight" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span class="input-group-text">
                          kg
                            </span>
                        </div>
                    </div>
                    </div>
                </div>



                <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
            </form>
        </div>

    </div>
</div>
@endsection
