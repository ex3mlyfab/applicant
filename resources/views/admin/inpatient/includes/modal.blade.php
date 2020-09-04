 <!-- Normal Block Modal -->
 <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Microbiology Request</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">

                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
 <!-- Histology Block Modal -->
 <div class="modal" id="histology-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">Histopathology</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                <form action="{{route('histopathologyreq.store')}}" method="post" class="px-3">
                        @csrf
                        <div class="form-group">
                            <label >Clinical Details</label>
                            <input type="text" name="clinical_details"  class="form-control">
                            <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                        </div>
                        <div class="form-group form-row">
                            <div class="col-sm-3">
                                <label for="test-date">Test Date</label>
                                <input type="text" name="test_date" id="test-date" class="js-datepicker form-control"  data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                            </div>
                            <div class="col-sm-3">
                                <label for="lmp">L. M. P</label>
                                <input type="text" name="lmp" id="lmp" class="js-datepicker form-control" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                            </div>
                            <div class="col-sm-3">
                                <label for="last_test-date">Last Test Date</label>
                                <input type="text" name="last_test_date" id="last_test-date" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label for="last_test_id">Test Details</label>
                                <input type="text" name="last_test_id" id="last_test_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-sm-4">
                                <label for="religion">Religion</label>
                                <select name="religion" id="religion" class="form-control">
                                    <option value="">select one ....</option>
                                    <option value="muslim">Muslim</option>
                                    <option value="christian">Christian</option>
                                    <option value="traditional">Traditional</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="marriage_type">Marriage_Type</label>
                                <select name="marriage_type" id="marriage_type" class="form-control">
                                    <option value="">select one....</option>
                                    <option value="monogamous">Monogamous</option>
                                    <option value="polygamous">Polygamous</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="husband_occupation">Husband Occupation</label>
                                <input type="text" name="husband_occupation" id="husband_occupation" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-6">
                                <label >Specimen Type</label>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input specimen" id="cervical_scrape" name="specimen_type" value="Cervical Scrape" checked>
                                    <label class="custom-control-label" for="cervical_scrape">Cervical Scrape</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input specimen" id="vaginal_scrape" name="specimen_type" value="Vaginal Scrape" >
                                    <label class="custom-control-label" for="vaginal_scrape">Vaginal Scrape</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input specimen" id="cytopipette" name="specimen_type" value="Cytopipette" >
                                    <label class="custom-control-label" for="cytopipette">Cytopipette</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input specimen" id="fine_needle_aspiration" name="specimen_type" value="Fine needle aspiration" >
                                   <label class="custom-control-label" for="fine_needle_aspiration">Fine needle aspiration</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="others" name="specimen_type" value="Fine needle aspiration" >
                                    <label class="custom-control-label" for="others">Others (specify)</label>
                                    <input type="text" name="specify" id="specify" class="form-control form-control-lg">
                                </div>

                            </div>
                            <div class="col-md-6">
                            <fieldset class="border border-success p-2 bg-amethyst-light">
                                <legend class="px-1">Pregnancies</legend>

                                <label for="total_birth">Total births(lives & still)</label>
                                <input type="text" name="total_birth" id="total_birth" class="form-control">

                                <label for="abortion_miscarriage">Total Abortion &amp; Miscarriage</label>
                                <input type="text" name="abortion_miscarriage" id="abortion_miscarriage" class="form-control">


                        </fieldset>
                    </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label>Condition</label>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="pregnant" name="condition" value="pregnant" >
                                    <label class="custom-control-label" for="pregnant">Pregnant</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="post_natal" name="condition" value="post_natal" >
                                    <label class="custom-control-label" for="post_natal">Post Natal</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="iucd" name="condition" value="iucd" >
                                    <label class="custom-control-label" for="iucd">IUCD</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="copper" name="condition" value="copper" >
                                    <label class="custom-control-label" for="copper">Copper</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="oral_contra" name="condition" value="oral_contra" >
                                    <label class="custom-control-label" for="oral_contra">Oral Contra</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="dpo_provera" name="condition" value="dpo_provera" >
                                    <label class="custom-control-label" for="dpo_provera">Dpo-Provera</label>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <label>Appearance of Cervix</label>
                                    <div class="custom-control custom-radio custom-control-lg mb-1">
                                        <input type="radio" class="custom-control-input" id="normal" name="cervix_appearance" value="normal" >
                                        <label class="custom-control-label" for="normal">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-lg mb-1">
                                        <input type="radio" class="custom-control-input" id="cervicitis" name="cervix_appearance" value="cervicitis" >
                                        <label class="custom-control-label" for="cervicitis">Cervicitis</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-lg mb-1">
                                        <input type="radio" class="custom-control-input" id="malignant" name="cervix_appearance" value="malignant" >
                                        <label class="custom-control-label" for="malignant">Malignant</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-lg mb-1">
                                        <input type="radio" class="custom-control-input" id="eroded" name="cervix_appearance" value="eroded" >
                                        <label class="custom-control-label" for="eroded">Eroded</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-lg mb-1">
                                        <input type="radio" class="custom-control-input" id="polyps" name="cervix_appearance" value="polyps" >
                                        <label class="custom-control-label" for="polyps">Polyps</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-lg mb-1">
                                        <input type="radio" class="custom-control-input" id="organ" name="cervix_appearance" value="organ" >
                                        <label class="custom-control-label" for="organ">Organ/site of needle aspiration</label>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <label> Symptoms</label>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="discharge" name="symptoms" value="discharge" >
                                    <label class="custom-control-label" for="discharge">Discharge</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="post_coital_bleeding" name="symptoms" value="post coital bleeding" >
                                    <label class="custom-control-label" for="post_coital_bleeding">Post Coital Bleeding</label>

                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="post_menopausal_bleeding" name="symptoms" value="post menopausal bleeding" >
                                    <label class="custom-control-label" for="post_menopausal_bleeding">Post menopausal Bleeding</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-lg mb-1">
                                    <input type="radio" class="custom-control-input" id="others_symptoms" name="symptoms" value="Fine needle aspiration" >
                                    <label class="custom-control-label" for="others_symptoms">Others (specify)</label>
                                    <input type="text" id="specify_symptoms" class="form-control form-control-lg">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="submit" class="btn btn-outline-info btn-lg w-100"> Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- END Histology Block Modal -->
 <!-- Blood Block Modal -->
 <div class="modal" id="blood-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">Blood Bank Request</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                <form action="{{route('bloodreq.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                    <div class="form-group form-row">
                        <div class="col-md-8">
                            <label for="diagnosis">Diagnosis</label>
                            <input type="text" name="diagnosis" id="diagnosis" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-2">
                            <label for="blood_group">Blood Group</label>
                            <input type="text" name="blood_group" id="blood_group" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-2">
                            <label for="genotype">Genotype</label>
                            <input type="text" name="genotype" id="genotype" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-4">
                            <label>Previous Transfusion</label>
                            <div class="form-check">
                                <input type="radio" name="previous_transfusion" value="yes" id="yes" class="form-check-input">
                                <label for="yes" class="form-check-label" >Yes</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="previous_transfusion" id="no" class="form-check-input" >
                                <label for="no" class="form-check-label">no</label>
                            </div>
                            <div class="form-check"><input type="radio" name="previous_transfusion" id="not_known" class="form-check-input">
                            <label for="not_known" class="form-check-label">Not known
                            </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="date_of_previous">Date of Previous Transfusion</label>
                            <input type="text" name="date_of_previous" id="date_of_previous" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-4">
                            <label for="previous_transfusion_rx">Type of Previous Transfusion Reaction</label>
                            <input type="text" name="previous_transfusion_rx" id="previous_transfusion_rx" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-4"><label for="no_of_pregnancies">
                            no of pregnancies</label>
                            <input type="text" name="no_of_pregnancies" id="no_of_pregnancies" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-4">
                            <label for="no_of_stillbirths">No of Stillbirths</label>
                            <input type="text" name="no_of_stillbirths" id="no_of_stillbirths" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-4">
                            <label for="no_of_jaundiced_babies">no of jaundiced babies</label>
                            <input type="text" name="no_of_jaundiced_babies" id="no_of_jaundiced_babies" class="form-control form-control-lg">
                        </div>
                    </div>
                    <fieldset>
                        <legend>Cross Match Request</legend>
                        <div class="form-group form-row">
                        <div class="col-md-4">
                            <label for="no_of_units_required">no of units required
                            </label>
                            <input type="text" name="no_of_units_required" id="no_of_units_required" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-4">
                            <label for="mode">form needed</label>
                            <input type="text" name="mode" id="mode" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-4">
                            <label for="date_required">date and time required</label>
                            <input type="text" name="date_required" id="date_required" class="form-control form-control-lg">
                        </div>
                    </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>

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
<!-- END blood Block Modal -->
 <!-- microbiology Modal -->
 <div class="modal" id="microbiology-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-top" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-flat-light text-white-75">
                    <h3 class="block-title">Microbiology Request</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                <form action="{{route('microreq.store')}}" method="post" class="bg-flat text-white px-2">
                    @csrf
                        <div class="form-group">
                            <label > Nature of Specimen</label>
                            <input type="text" name="specimen"  class="form-control form-control-lg">
                            <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                        </div>
                        <div class="form-group">
                            <label > Diagnosis and Clinical Details</label>
                            <textarea type="text" name="clinical_information"  class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label > investigation required</label>
                            <input type="text" name="examination_required"  class="form-control form-control-lg">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>
                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END microbiology Modal -->
 <!-- Pharmacy Modal -->
 <div class="modal" id="pharmacy-block-normal" tabindex="-1" role="dialog" aria-labelledby="pharmacy-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-top" role="document" >
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">Drug Request</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <form action="{{route('pharmreq.store') }}" method="POST" class="form form-element" onsubmit="return false;">
                            @csrf
                            <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                            <table class="table table-bordered table-striped" id="drugs">
                                <thead>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Drug Name/ Form</th>
                                <th>Dosage</th>
                                <th>Instruction</th>

                                <th style="text-align: center;background: #eee">

                                </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <select  class="js-select2 form-control" style="width: 100%;" data-placeholder="Choose one.." id="category" required>
                                            <option></option>
                                            {{ create_option('drug_categories','id', 'name')}}
                                        </select>
                                    </td>
                                    <td>
                                        <select  class="js-select2 form-control" style="width: 100%;" id="drug-subcategory" data-placeholder="Choose one.." required>
                                        <option></option>
                                    </select>
                                    </td>
                                    <td>
                                        <select  class="js-select2 form-control" style="width: 100%;" id="drug" data-placeholder="Choose one.." required>
                                        <option></option>
                                    </select></td>

                                    <td>

                                        <input type="text" id="dosage" class="form-control form-control-lg"></td>
                                    <td>
                                        <input type="text" id="instruction" class="form-control form-control-lg">
                                    </td>


                                    <td  style="text-align: center">
                                            <a  class="btn btn-success" onclick="rowAdd()">
                                                <i class="fa fa-plus"> Add Drug</i>
                                            </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>





                    <button  id="drugSubmit" data-appointment="{{$appointment->id}}" class="btn btn-primary pull-right">Submit</button>
                        </form>

                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
</div>

<!-- Pharmacy Modal -->
<!-- Haematology Block Modal -->
<div class="modal" id="haematology" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">Haematology Request</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                <form action="{{route('haematologyreq.store')}}" method="post" class="bg-danger-light px-1">
                        @csrf
                        <div class="form-group form-row">

                            <div class="col-md-3">
                                <label >Clinical Details</label>
                                <input type="text" name="clinical_details"  class="form-control">
                            <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mt-4">
                                    <input type="checkbox" name="fbc" id="fbc" class="custom-control-input" value="fbc"><label for="fbc" class="custom-control-label">FBC</label>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="investigation_required">Investigation Required</label>
                                <input type="text" name="investigation_required" id="investigation_required" class="form-control" required>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="hb" id="hb" class="custom-control-input fbc" ><label for="hb" class="custom-control-label">Hb</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="hb_value" id="hb_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> g/dl</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Anisocytosis</span>
                                            </div>

                                            <input type="text" name="anisocytosis" id="anisocytosis" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Target Cells</span>
                                            </div>

                                            <input type="text" name="target_cells" id="target_cells" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">BLAST</span>
                                            </div>

                                            <input type="text" name="blast" id="blast" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr class="m-0 p-0">
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="pcv" id="pcv" class="custom-control-input fbc" ><label for="pcv" class="custom-control-label">PCV</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="pcv_value" id="pcv_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">poikilocytosis</span>
                                            </div>

                                            <input type="text" name="poikilocytosis" id="poikilocytosis" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Sickle Cells</span>
                                            </div>

                                            <input type="text" name="sickle_cells" id="sickle_cells" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">PROMYEL</span>
                                            </div>

                                            <input type="text" name="promyel" id="promyel" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr class="m-0 p-0">
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="rbc" id="rbc" class="custom-control-input fbc" ><label for="rbc" class="custom-control-label">RBC</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="rbc_value" id="rbc_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> X15 <sup>12/1</sup></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Microcytosis</span>
                                            </div>

                                            <input type="text" name="microcytosis" id="microcytosis" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td rowspan="2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Nucleated RBC</span>
                                            </div>

                                            <input type="text" name="nucleated_rbc" id="nucleated_rbc" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">MYEL</span>
                                            </div>

                                            <input type="text" name="myel" id="myel" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="mcv" id="mcv" class="custom-control-input fbc" ><label for="mcv" class="custom-control-label">MCV</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="mcv_value" id="mcv_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> fi</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Macrocytosis</span>
                                            </div>

                                            <input type="text" name="macrocytosis" id="macrocytosis" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>

                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">METAMYEL</span>
                                            </div>

                                            <input type="text" name="metamyel" id="metamyel" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="mch" id="mch" class="custom-control-input fbc" ><label for="mch" class="custom-control-label">MCH</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="mch_value" id="mch_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> pg</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Hypochromia</span>
                                            </div>

                                            <input type="text" name="hypochromia" id="hypochromia" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td rowspan="2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Plat (on film)</span>
                                            </div>

                                            <input type="text" name="plat_on_film" id="plat_on_film" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>
                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">NEUT</span>
                                            </div>

                                            <input type="text" name="neut" id="neut" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="mchc" id="mchc" class="custom-control-input fbc" ><label for="mchc" class="custom-control-label">MCHC</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="mchc_value" id="mchc_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> g/dl</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">polychromasia</span>
                                            </div>

                                            <input type="text" name="polychromasia" id="polychromasia" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>

                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">LYMPH</span>
                                            </div>

                                            <input type="text" name="lymph" id="lymph" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="retic" id="retic" class="custom-control-input fbc" ><label for="retic" class="custom-control-label">Retic</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="retic_value" id="retic_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2" rowspan="3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-alt">Other results/Comment</span>
                                            </div>

                                            <input type="text" name="other_result" id="other_result" class="form-control form-control-alt" readonly>

                                        </div>
                                    </td>

                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">MONO</span>
                                            </div>

                                            <input type="text" name="mono" id="mono" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="wbc" id="wbc" class="custom-control-input fbc" ><label for="wbc" class="custom-control-label">WBC</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="wbc_value" id="wbc_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">X15 <sup>9/1</sup> </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-bordered border-info">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">EOSIN</span>
                                            </div>

                                            <input type="text" name="eosin" id="eosin" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="plat" id="plat" class="custom-control-input fbc" ><label for="plat" class="custom-control-label">plat</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="plat_value" id="plat_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> X15 <sup>9/1</sup></span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-bordered border-info" rowspan="2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">BASO</span>
                                            </div>

                                            <input type="text" name="baso" id="baso" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                        <input type="checkbox" name="esr" id="esr" class="custom-control-input fbc" ><label for="esr" class="custom-control-label">esr</label>
                                        </div>
                                    </td>
                                    <td style="width:15%;" class="pl-0 ml-0">
                                        <div class="input-group">

                                            <input type="text" name="esr_value" id="esr_value" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Haematology Block Modal -->
<!-- ultrasound Block Modal -->
 <div class="modal" id="ultrasound" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-flat text-white-75">
                    <h3 class="block-title">Radiology(Ultrasound) Request</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <form action="{{route('ultrasoundreq.store')}}" method="post" class="bg-flat text-white px-2">
                        @csrf
                        <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                        <div class="form-group">
                            <label for="request_type"> Request Type:</label>
                            <div class="form-check">
                                <input type="radio" name="request_type" id="xray" class="form-check-input" value="yes">
                                <label for="xray" class="form-check-label">Xray</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="request_type" id="ultrasound" class="form-check-input" value="no">
                                <label for="ultrasound" class="form-check-label">Ultrasound</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <label >Clinical Information</label>
                            <input type="text" name="clinical_information"  class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label > investigation required</label>
                            <textarea name="examination_required"  class="form-control form-control-lg">
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>



                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End Ultrasound request-->

<!-- xray Block Modal -->
<div class="modal" id="admit" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-gray text-white-75">
                    <h3 class="block-title">Admit request
                    </h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <form action="{{route('radiologyreq.store')}}" method="post" class="bg-flat text-white px-2">
                        @csrf
                        <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                        <div class="form-group">
                            <label >Clinical Information</label>
                            <input type="text" name="clinical_information"  class="form-control form-control-lg" required>
                        </div>
                        <div class="form-group">
                            <label > Reason for Admission</label>
                            <textarea name="reason"  class="form-control form-control-lg">
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>



                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="tca" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-success text-white-75">
                    <h3 class="block-title">Tca
                    </h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <form action="{{route('radiologyreq.store')}}" method="post" class="bg-flat text-white px-2">
                        @csrf
                        <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                        <div class="form-group">
                            <label >Clinical Information</label>
                            <input type="text" name="clinical_information"  class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <input type="text" class="js-datepicker form-control" id="int123" name="call_again" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>



                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End xray request-->
<!-- Pathology Block Modal-->
<div class="modal" id="pathology" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-top modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-white-50">
                    <h3 class="block-title text-black">Pathology &amp; Immunology</h3>
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
                                     <img src="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
                                </div>
                                <div class="col-md-8 font-size-sm">
                                     <p class="my-0"> Name:&nbsp;<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No:&nbsp; <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:&nbsp;{{$patient->sex}}</p>
                                    <p>Age:&nbsp; {{$patient->age}}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                <form action="{{route('pathologyreq.store')}}" method="post" bg-white-50 text-black>
                        @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label >Clinical Details</label>
                                <input type="text" name="clinical_details"  class="form-control form-control-lg">
                            </div>
                            <div class="col-md-4">
                                <label >Nature of Specimen</label>
                                <input type="text" name="specimen"  class="form-control form-control-lg">
                            </div>
                            <div class="col-md-4">
                                <label for="date_of_collection">Date of Collection</label>
                                <input type="text" name="date_of_collection" id="date_of_collection" class="form-control form-control-lg">
                            </div>
                        </div>
                        <hr>

                        <div class="row no-gutters text-center">
                            <div class="col-sm-1 m-0 p-0">
                                <input type="checkbox" name="sodium" value="1"><br>
                                <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                <input type="text" name="sodium_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0">
                                <input type="checkbox" name="potassium" value="1" ><br>
                                <label for="">POTASSIUM<br>mmoL/l<br>2.9.5.0</label>
                                <input type="text" name="potassium_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0">
                                <input type="checkbox" name="hc03" value="1" ><br>
                                <label for="">Hco<sub>3</sub><br>mmoL/l<br>21.28</label>
                                <input type="text" name="hc03_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0">
                                <input type="checkbox" name="chloride" value="1"><br>
                                <label for="">CHLORIDE<br>mmoL/l<br>95-106</label>
                                <input type="text" name="chloride_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="urea" value="1"><br>
                                <label for="">UREA<br>mmoL/l<br>2.5-6.5</label>
                                <input type="text" name="urea_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="creatinine" value="1" ><br>
                                <label for="">CREATININE<br>mmoL/l<br>53-106</label>
                                <input type="text" name="creatinine_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="urate" value="1" ><br>
                                <label>URATE<br>mmoL/l<br>0.2-0.45</label>
                                <input type="text" name="urate_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="calcium" value="1" ><br>
                                <label for="">CALCIUM<br>mmoL/l<br>2.25-2.65</label>
                                <input type="text" name="calcium_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="phosphate" value="1"><br>
                                <label>PHOSPHATE<br>mmoL/l<br>0.6-1.4</label>
                                <input type="text" name="phosphate_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="glucose" value="1" ><br>
                                <label>GLUCOSE<br>mmoL/l<br>135-145</label>
                                <input type="text" name="glucose_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="gly-hb" value="1" ><br>
                                <label>GLY-HB<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="gly-hb" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="cholesterol" value="1" ><br>
                                <label>Cholesterol<br>mmoL/l<br>2.0-5.2</label>
                                <input type="text" name="cholesterol_value" class="form-control">
                            </div>

                        </div>
                        <hr>
                        <div class="row no-gutters text-center">
                            <div class="col-sm-1 m-0 p-0 block-bordered">
                                <input type="checkbox" name="triglycerides" value="1"><br>
                                <label>TRIGLYCERIDES<br>mmoL/l<br>0.3-1.7</label>
                                <input type="text" name="triglycerides_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 block-bordered">
                                <input type="checkbox" name="ldl-c" value="1"><br>
                                <label>LDL-C<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="ldl-c_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="hdl-c" value="1"><br>
                                <label>HDL-C<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="hdl-c_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="alt" value="1"><br>
                                <label>ALT<br>IU/L<br>0-15</label>
                                <input type="text" name="alt_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="ast" value="1"><br>
                                <label for="">AST<br>IU/L<br>0-20</label>
                                <input type="text" name="ast_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="alk-phos" value="1"><br>
                                <label>ALK.PHOS<br>IU/L<br>21-91</label>
                                <input type="text" name="alk-phos_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="ggt" value="1"><br>
                                <label for="">GGT<br>IU/L<br>i455</label>
                                <input type="text" name="ggt_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="amylase" value="1"><br>
                                <label >AMYLASE</label><br>IU/L<br>0-15</label>
                                <input type="text" name="amylase_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="total_acid" value="1"><br>
                                <label for="">Total Acid Phos <br>IU/L<br>0-10</label>
                                <input type="text" name="total_acid_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="total_bilirubin" value="1"><br>
                                <label for="">Total Bilirubin<br>umoL/L<br>0-2</label>
                                <input type="text" name="total_bilirubin_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="conj_bilirubin" value="1"><br>
                                <label>CONJ BILIRUBIN<br>umoL/L<br>0-2</label>
                                <input type="text" name="conj_bilirubin_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="total_protein" value="1"><br>
                                <label for="">Total Protein<br>g/l<br>35/50</label>
                                <input type="text" name="total_protein_value" class="form-control">
                            </div>

                        </div>
                        <hr>

                        <div class="row no-gutters text-center">
                            <div class="col-sm-1 m-0 p-0 block-bordered">
                                <input type="checkbox" name="albumin" value="1"><br>
                                <label>ALBUMIN<br>G/L<br>35/50</label>
                                <input type="text" name="albumin_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 block-bordered">
                                <input type="checkbox" name="csf_protein" value="1"><br>
                                <label>CSF Protein<br>mg/dl<br>45-45</label>
                                <input type="text" name="csf_protein_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="hdl-c" value="1"><br>
                                <label>CSF Sugar<br>mmol/l<br>22/3.9</label>
                                <input type="text" name="hdl-c_value" class="form-control">
                            </div>
                            <div class="col-sm-3 m-0 p-0 border-info">
                                <input type="checkbox" name="pes" value="1"><br>
                                <label>Protein Electrophoretic strip<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="pes_value" class="form-control">
                            </div>

                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="ft3" value="1"><br>
                                <label>FT 3<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="ft3_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="ft4" value="1"><br>
                                <label for="">FT 4<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="ft4_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="total_t3" value="1"><br>
                                <label >Total T3</label><br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="total_t3_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="total_acid" value="1"><br>
                                <label for="">Total T4<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="total_acid_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="tsh" value="1"><br>
                                <label for="">TSH<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="tsh_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="fsh" value="1"><br>
                                <label>FSH<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="fsh_value" class="form-control">
                            </div>


                        </div>
                        <div class="row no-gutters text-center">
                            <div class="col-sm-1 m-0 p-0 block-bordered">
                                <input type="checkbox" name="lh" value="1"><br>
                                <label>LH<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="lh_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 block-bordered">
                                <input type="checkbox" name="protactin" value="1"><br>
                                <label>Proctactin<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="protactin_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="progesterone" value="1"><br>
                                <label>Progesterone<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="progesterone_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="estrogen" value="1"><br>
                                <label>ESTROGEN<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="estrogen_value" class="form-control">
                            </div>

                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="testosterone" value="1"><br>
                                <label>Testosterone<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="testosterone_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="psa" value="1"><br>
                                <label>PSA<br>ng/ml<br>0-4.5</label>
                                <input type="text" name="psa_value" class="form-control">
                            </div>
                            <div class="col-sm-1 m-0 p-0 border-info">
                                <input type="checkbox" name="rf" value="1"><br>
                                <label >RF</label><br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="rf_value" class="form-control">
                            </div>
                            <div class="col-sm-2 m-0 p-0 border-info">
                                <input type="checkbox" name="pregnancy_test" value="1"><br>
                                <label for="">Pregnancy Test<br>&nbsp;<br>&nbsp;</label>
                                <input type="text" name="pregnancy_test_value" class="form-control">
                            </div>



                        </div>


                </div>
                <div class="block-content block-content-full text-right border-top">

                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!--end Pathology Block Modal -->

