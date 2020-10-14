<!--take vital signs-->
<div class="modal" id="vital-signs" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-lg" role="document">
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
                                        <label for="patient_identity"> PATIENT NAME</label>
                                        <input type="text" class="form-control form-control-lg" id="fullname1" readonly>
                                        <input type="hidden" name="patient_id"  id="patient_identity" >
                                        <input type="hidden" name="consultation_room"  id="consultation_room" value="1" >

                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <label for="folder_no">FOLDER NUMBER</label>
                                            <input type="text" name="folder_number" id="folder_no"  class="form-control form-control-lg" readonly>


                                            </div>
                                            <div class="col-md-12">
                                                <label for="gender0">SEX</label>
                                            <input type="text" name="sex" id="gender0"  class="form-control form-control-lg" readonly>


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

            </div>
        </div>
    </div>
</div>
<!-- Allergy Block Modal -->
<div class="modal" id="allergy-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Patient Reaction Details </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <h3 class="text-center">Add Allergic Reaction</h3>
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="reaction">Allergic to:</label>
                            <input type="text" name="allergy" id="reaction">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="miniverse" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Treatment Step</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <div class="block block-fx-pop">
                        <div class="block-header bg-info-dark"></div>
                        <div class="block-content ">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                     <img src="{{asset('backend')}}/images/avatar/{{$inpatient->user->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$inpatient->user->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$inpatient->user->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$inpatient->user->sex}}</p>
                                    <p>Age:&nbsp; {{$inpatient->user->age}}</p>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p>Treatment step</p>
                                </div>
                                <div class="col-md-12 bg-amethyst text-uppercase mb-3 rounded">

                                    <h3 class="text-center my-1" id="treatment-title"></h3>
                                </div>
                                <div class="col-md-12 text-right">

                                </div>

                            </div>

                        <form action="{{route('recordtreatment')}}" method="POST" id="treatment-step">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <input type="hidden" name="id" id="treatment-id">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-6 mt-2" id="payment-status">

                                            <div class="form-check mt-3">
                                                <label class=""> Mark as done</label>
                                                <input type="checkbox" name="do" class="form-check-inline" style="height:15px; width:15px;" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <div class='input-group date' id='datetimepicker3'>
                                                <input type='text' class="form-control" name="date_of_admission" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center align-item-center">
                                    <button type="submit" class="btn btn-outline-primary btn-lg mt-3" id="treatment-done"><i class="fa fa-save"></i> Save</button>
                                </div>

                        </form>

                        </div>
                    </div>

                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
