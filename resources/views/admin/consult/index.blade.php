@extends('admin.admin')

@section('title')
    Consult patients
@endsection

@section('content')
<div class="content">
    <div class="block block-fx-pop">
        <div class="block-header bg-info-light">
            <h3 class="block-title"> Patient List</h3>
        </div>
        <div class="col-lg-12">

                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-alt-static-home">Appointment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-alt-static-profile">Patient Register</a>
                        </li>

                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                            <h4 class="font-w400">Patient on Appointment</h4>
                             <div class="block block-bordered block-fx-pop">

                                <div class="block-content block-content-full">
                                    <h4 class="font-w400">Today's Appointment {{ now()->today()->format('d-M-Y')}}</h4>
                                        <div class="table-responsive">
                                                <table class="table table-stripped table-bordered table-vcenter">
                                                    <thead>
                                                        <th>S/no</th>
                                                        <th>Name</th>
                                                        <th>Picture/f-no</th>
                                                        <th>sex</th>
                                                        <th>Age</th>
                                                        <th>status</th>
                                                        <th>action</th>
                                                    </thead>
                                                        <tbody>
                                                            @foreach ($today as $item)
                                                            <tr>
                                                                <td>
                                                                    {{$loop->iteration}}
                                                                </td>
                                                                <td>
                                                                    {{ $item->user->full_name}}
                                                                </td>
                                                                <td>
                                                                    <img src="{{ $item->user->avatar ? asset('backend/images/avatar/'. $item->user->avatar) : asset('backend/images/no_image.png')}}" alt="" class="img-avatar img-avatar96"><br>
                                                                    <span class="badge badge-pill p-2 badge-light">
                                                                        {{$item->user->folder_number}}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{$item->user->sex}}

                                                                </td>
                                                                <td>
                                                                    {{$item->user->age}}
                                                                </td>

                                                                <td>
                                                                    <span class="badge badge-primary"> {{$item->status}}</span>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group">

                                                                        <button type="button" class="btn btn-md btn-danger text-uppercase takevitals" data-toggle="modal"  data-target="#modal-block-normal" data-pictures="{{asset('backend')}}/images/avatar/{{$item->user->avatar}}" data-fullname="{{ $item->user->full_name}}" data-patient-id="{{$item->user->id}}" data-folder-number="{{ $item->user->folder_number}}" data-sex="{{ $item->user->sex}}"><span data-toggle="tooltip" title="take vitals sign"> <i class="fa fa-fw fa-clipboard"></i> </span></button>
                                                                        @if ( ($item->status == "vitals sign taken"))
                                                                    <a href="{{route('consult.create', $item->user->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Start Consultation">
                                                                                <i class="fa fa-fw fa-stethoscope"></i>
                                                                            </a>
                                                                        @endif

                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                            <h4 class="font-w400">Profile Content</h4>
                            <p>...</p>
                        </div>

                    </div>
                </div>
        <!-- END Blockss="block-content block-content-full">
              Tabs Alternative Style -->
            </>
        </div>
    </div>
    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-top modal-lg" role="document"style=" width: 80%;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title">Vitals signs Record</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm mt-0">
                        <div class="block block-fx-pop">

                            <div class="block-content content-full">
                                <form action="{{route('nursing.store')}}" method="post" class="mb-4">
                                    @csrf
                                    <div class="form-group form-row">
                                        <div class="col-md-4">
                                        <img  alt="" id="picture">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="patient_id"> PATIENT NAME</label>
                                            <input type="text" class="form-control form-control-lg" id="fullname" readonly>
                                            <input type="hidden" name="patient_id"  id="patient_id" >
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                <label for="folder_number">FOLDER NUMBER</label>
                                                <input type="text" name="folder_number" id="folder_number"  class="form-control form-control-lg" readonly>


                                                </div>
                                                <div class="col-md-12">
                                                    <label for="sex">SEX</label>
                                                <input type="text" name="sex" id="sex"  class="form-control form-control-lg" readonly>


                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-md-2">
                                            <label for="diastolic">BLOOD PRESSURE</label>

                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" name="systolic" id="sytolic" placeholder="SYST" class="form-control form-control-lg" >
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" name="diastolic" id="diastolic" placeholder="DIAST" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-md-3">
                                            <label for="temp">TEMPERATURE</label>
                                            <div class="input-group">
                                                <input type="text" name="temp" id="temp" class="form-control placeholder="TEMP" form-control-lg">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                       <sup>o</sup> C
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="rr">RESPIRATORY RATE</label>
                                            <div class="input-group">
                                            <input type="text" name="rr" id="rr" placeholder="RR" class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                   bpm
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pr">PULSE RATE</label>
                                            <div class="input-group">
                                            <input type="text" name="pr" id="pr" placeholder="PR" class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                              bpm
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="spo2">SPO<sub>2</sub></label>
                                            <div class="input-group">
                                            <input type="text" name="spo2" id="spo2" placeholder="SPO2" class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                              bpm
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-row">

                                        <div class="col-md-4">
                                            <label for="weight">WEIGHT</label>
                                            <div class="input-group">
                                            <input type="text" name="weight" id="weight" placeholder="Weight" class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                              kg
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="height">HEIGHT</label>
                                            <div class="input-group">
                                            <input type="text" name="height" id="height" placeholder="Height in meters" class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                   m
                                                </span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="bmi">BMI</label>
                                            <div class="input-group">
                                            <input type="text" name="bmi" id="bmi" placeholder="bmi" class="form-control form-control-lg" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                              kg/m<sup>2</sup>
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
                    <div class="block-content block-content-full text-right border-top">

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('foot_js')
<script>
    $(function(){

        var weight, height, bmi;
        $('.takevitals').bind('click',function(){
            $('#picture').attr('src', $(this).data('pictures'));
            $('#fullname').val( $(this).data('fullname'));
            $('#folder_number').val( $(this).data('folder-number'));
            $('#sex').val( $(this).data('sex'));
            $('#patient_id').val( $(this).data('patient-id'));
        });

        $('#height').prop("readonly", true);
        $('#bmi').val('Enter weight and Height for Bmi');

        $('#weight').on('blur', function(){
            weight = $(this).val();
            $('#height').prop("readonly",false );

        });
        $('#height').on('blur', function(){
            height = $(this).val();
            bmi = weight/(height*height);

            $('#bmi').val(bmi.toFixed(2));
        });

        $('tbody tr:nth-child(odd)').addClass("bg-city-lighter");
    });
</script>

@endsection
