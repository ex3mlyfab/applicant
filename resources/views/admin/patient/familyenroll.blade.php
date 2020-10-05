@extends('admin.admin')

@section('title')
    add new patient
@endsection

@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<style>
    #my_camera{
    width: 200px;
    height: 200px;
    border: 1px solid black;
    }
</style>

@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Validation Wizard 2 -->
            <div class="js-wizard-validation2 block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-validation2-step1" data-toggle="tab">1. Family Name</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step2" data-toggle="tab">2. Personal Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step3" data-toggle="tab">3. Next of Kin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step4" data-toggle="tab">4. Image</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
            <form class="js-wizard-validation2-form" action="{{route('family.store')}}" method="POST">
                @csrf
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 303px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-validation2-step1" role="tabpanel">
                            <div class="form-group">
                                <label class="d-block">Family Name</label>
                            <input type="hidden"  name="registration_type_id" readonly value="{{ $family->registration_type_id }}">
                            <input type="text"  class="form-control form-control-lg" readonly value="{{ $family->users->first()->last_name}}" >
                            <input type="hidden" name="belongs_to" value="{{$family->id}}" >

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{asset('backend')}}/images/avatar/{{$family->users->first()->avatar}}" alt="{{$family->users->first->full_name}}" class="rounded" style="max-width: 100%;">
                                </div>
                                <div class="col-md-4">
                                    <h3 class="block-title">Address</h3>
                                    <p>{{$family->users->first()->address}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="block-title"> Phone Number</h3>
                                    <p>{{$family->users->first()->phone}}</p>
                                </div>

                            </div>

                        </div>
                        <!-- END Step 1 -->
                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-validation2-step2" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-4">
                                    <label for="wizard-validation2-lastname">Last Name</label>
                                <input placeholder="Enter last name" style="border: 1px solid rgb(51, 70, 128)" class="form-control form-control-lg" type="text" id="wizard-validation2-lastname" name="last_name" value="{{$family->users->first()->last_name ?? old('last_name')}}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="wizard-validation2-firstname">Other Names</label>
                                <input placeholder="Other Names" style="border: 1px solid rgb(51, 70, 128)" class="form-control form-control-lg" type="text" id="wizard-validation2-othername" name="other_names" value="{{old('other_names')}}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="wizard-validation2-phone">Phone Number</label>
                                    <input class="form-control form-control-lg" placeholder="Enter Phone Number" style="border: 1px solid rgb(51, 70, 128)" type="number" id="wizard-validation2-phone" name="phone" value="{{old('phone')}}" required>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="int123" class="text-bold-600 font-medium-2">
                                            Date of Birth :
                                        </label><a href="#" id="switch">estimated age? click</a>

                                        <input type="text" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="js-datepicker form-control" id="int123" name="dob" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"
                                    value="{{old('dob')}}">
                                    <input type="text"  name="age_at_reg" class="form-control form-control-lg" id="int124" placeholder="Enter estimated Age" value="{{old('age_at_reg')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="select-sex">Sex</label>
                                    <select class="form-control form-control-lg p-2" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" id="select-sex" name="sex" style="border: 1px solid rgb(51, 70, 128)" required>
                                        <option value="">Choose One...</option>
                                        <option value="Male" {{ (old('sex')=='Male') ? 'select' :''}}>Male</option>
                                        <option value="Female" {{ old('sex')=='Female' ? 'select':''}}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="select-mar">Marital Status</label>
                                    <select class="form-control form-control-lg p-2" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" id="select-mar" name="marital_status" style="border: 1px solid rgb(51, 70, 128)" required>
                                        <option value="">Choose One...</option>
                                        <option value="Never Married" {{ old('marital_status')=='Never Married' ? 'select':''}}>Never Married(single)</option>
									    <option value="Married" {{ old('marital_status')=='married' ? 'select':''}}>Married</option>
									    <option value="widowed" {{ old('marital_status')=='Widowed' ? 'select':''}}>Widowed</option>
									    <option value="divorced" {{ old('marital_status')=='divorced' ? 'select':''}}>Divorced</option>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="email">Email</label>
                                <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg p-2" type="email" id="email" name="email" value="{{old('email')}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="select-sex">Religion</label>
                                    <select class="form-control form-control-lg" type="text" id="select-sex" name="sex" style="border: 1px solid rgb(51, 70, 128)" required>
                                        <option value="">Choose One...</option>
                                        <option value="Islam" {{ (old('religion')=='Islam') ? 'select' :''}}>Islam</option>
                                        <option value="Christian" {{ old('religion')=='Christianity' ? 'select':''}}>Christian</option>
                                        <option value="Traditional" {{ old('religion')=='Traditional' ? 'select':''}}>Traditional</option>
                                        <option value="Others" {{ old('religion')=='Others' ? 'select':''}}>Others</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="nin">Nationality</label>
                                    <input class="form-control form-control-lg" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" id="nin" name="nationality" value="{{old('nationality')}}" required>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-4">
                                    <label for="address">Address</label>
                                    <textarea class="form-control form-control-lg" id="address" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="address" rows="1" required>{{ $family->users->first()->address ?? old('address')}}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="city">City</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="city" name="city" value="{{$family->users->first()->city ?? old('city')}}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="city">State</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="state" name="state" value="{{$family->users->first()->state ?? old('state')}}" required>
                                </div>


                            </div>
                            <div class="form-group form-row">

								<div class="col-sm-4">
                                    <label for="tribe">TRIBE</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="tribe" name="tribe" value="{{$family->users->first()->tribe ?? old('tribe')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="occupation">Occupation</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="occupation" name="occupation" value="{{old('occupation')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="referral_source">Referral Source</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="referral_source" name="referral_source" value="{{old('referral_source')}}" >
                                </div>

                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-validation2-step3" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-12 mb-2">

                                        <label for="nok" class="text-bold-600 font-medium-2">
                                            Name of Next of Kin
                                        </label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" class="form-control form-control-lg" id="nok" name="nok" value="{{old('nok')}}" required>

                                </div>
                                <div class="col-md-12 mb-2">

                                        <label for="nok_relationship" class="text-bold-600 font-medium-2">
                                            Relationship
                                        </label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" class="form-control form-control-lg" id="nok_relationship" name="nok_relationship" value="{{old('nok_relationship')}}"required>
                               </div>
                                <div class="col-md-12 mb-2">

                                        <label for="nok_phone" class="text-bold-600 font-medium-2">
                                            Phone
                                        </label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" class="form-control form-control-lg required" id="nok_phone" name="nok_phone" value="{{old('nok_phone')}}">

                                </div>
                                <input type="hidden" name="source" value="front-desk">

                                <div class="col-md-12 mb-2">
                                    <div class="custom-control custom-checkbox custom-control-lg mt-2 mb-2">
                                        <input type="checkbox" class="custom-control-input" id="custom-lg1" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa">
                                        <label class="custom-control-label" for="custom-lg1">check if same as above</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="shortDescription3" class="text-bold-600 font-medium-2">Next of Kin Address</label>
                                        <textarea style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="nok_address" id="shortDescription3" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3-->

                        <!-- Step 4-->
                        <div class="tab-pane" id="wizard-validation2-step4" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-6 mt-3 d-flex">
                                <div>
                                        <div style="width: 500px; height: 300px" class="mt-3 d-flex justify-content-center text-center" id="my_camera"></div>
                                        <input id="startCamera" class="btn btn-primary mt-2" type=button value="Configure" onClick="configure()">
                                        <input id="takeCamera" class="btn btn-primary text-center mt-2" value="Take Snapshot" onClick="take_snapshot()">

                                </div>
                                    <div class="col-md-6">
                                        <div id="results" style="width: 500px; height: 300px" class="mt-3"></div>

                                </div>

                            </div>
                        </div>
                        <!-- END Step 4 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary d-flex" data-wizard="prev">
                                    <i style="font-size: 23px;" class="bx bx-chevrons-left bx-fade-right mr-2"></i> <span>Previous</span>
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn text-white d-flex ml-auto" style="background: rgb(51, 70, 128)" data-wizard="next">
                                    Next <i style="font-size: 23px;" class="bx bx-chevrons-right bx-fade-left ml-2"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Validation Wizard 2 -->
        </div>
    </div>
</div>
@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('backend')}}/assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/additional-methods.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_forms_wizard.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker', 'select2']); });</script>

<script src="{{asset('backend')}}/assets/js/webcam.min.js"></script>
<script>
    $(function(){
       $('#int124').hide();


       $('#switch').click(function(){
           $('#int123').toggle();
           $('#int124').toggle();
       });



       $('.datepicker').datepicker({
   formatSubmit:'yyyy/mm/dd'
   });

   });
    </script>
   <script language="JavaScript">
       // Configure a few settings and attach camera
       function configure(){
        Webcam.set({
         width: 200,
         height: 200,
         image_format: 'jpeg',
         jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
       }
       // A button for taking snaps


       // preload shutter audio clip
    //    var shutter = new Audio();
    //    shutter.autoplay = false;
    //    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

       function take_snapshot() {
        // play sound effect
        // shutter.play();

        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('results').innerHTML =
         '<img id="imageprev" src="'+data_uri+'" class="img-fluid"/>'+
         '<input type="hidden" name="avatar" value="'+data_uri+'"/>';
        } );

        Webcam.reset();
        document.getElementById('my_camera').hide=true;
       }



         </script>


@endsection
