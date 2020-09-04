@extends('admin.admin')

@section('title')
    edit {{$patient->full_name}}
@endsection

@section('head_css')
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
                        <a class="nav-link active" href="#wizard-validation2-step1" data-toggle="tab">1. Personal Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step2" data-toggle="tab">2. Next of Kin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step3" data-toggle="tab">3. Image</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
            <form class="js-wizard-validation2-form" action="{{route('patient.update', $patient->id)}}" method="POST">
                @csrf
                @method('PATCH')
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 303px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-validation2-step1" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-sm-4">
                                    <label for="wizard-validation2-lastname">Last Name</label>
                                <input class="form-control form-control-lg" type="text" id="wizard-validation2-lastname" name="last_name" value="{{$patient->last_name ?? old('last_name')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="wizard-validation2-firstname">Other Names</label>
                                <input class="form-control form-control-lg" type="text" id="wizard-validation2-othername" name="other_names" value="{{$patient->other_names ?? old('other_names')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="wizard-validation2-phone">Phone Number</label>
                                    <input class="form-control form-control-lg" type="text" id="wizard-validation2-phone" name="phone" value="{{$patient->phone ?? old('phone')}}" required>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-sm-4">
                                    <label for="select-sex">Sex</label>
                                    <select class="form-control form-control-lg" type="text" id="select-sex" name="sex" required>
                                        <option value="">Choose One...</option>
                                        <option value="Male" {{($patient->sex =='Male'|| old('sex')=='Male') ? 'selected="selected"': ''}}>Male</option>
                                        <option value="Female" {{($patient->sex =='Female'|| old('sex')=='Female') ? 'selected="selected"': ''}}>Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="select-mar">Marital Status</label>
                                    <select class="form-control form-control-lg" type="text" id="select-mar" name="marital_status" required>
                                        <option value="">Select status</option>
									<option value="Never Married" {{ ($patient->marital_status == 'Never Married') ? 'selected': ''}}>Never Married(single)</option>
									<option value="married" {{($patient->marital_status == 'married') ? 'selected': ''}} >Married</option>
									<option value="widow" {{($patient->marital_status == 'widow') ? 'selected': ''}}>Widow</option>
									<option value="divorced" {{($patient->marital_status == 'divorced') ? 'selected': ''}}>Divorced</option>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="int123" class="text-bold-600 font-medium-2">
                                            Date of Birth :
                                        </label><a href="#" id="switch">? click for estimated age</a>

                                        <input type="text" class="js-datepicker form-control" id="int123" name="dob" data-week-start="1" data-autoclose="true" data-today-highlight="false" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" >
                                    <input type="text"  name="age_at_reg" class="form-control form-control-lg" id="int124" placeholder="Enter estimateg Age" value="{{$patient->age_at_reg ?? old('age_at_reg')}}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group form-row">
                                <div class="col-sm-4">
                                    <label for="email">Email</label>
                                <input class="form-control form-control-lg" type="email" id="email" name="email" value="{{$patient->email ?? old('email')}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="address">Address</label>
                                    <textarea class="form-control form-control-alt" id="address" name="address" rows="4">{{ $patient->address ?? old('address')}}</textarea>
                                </div>
                                <div class="col-sm-2">
                                    <label for="city">City</label>
                                    <input class="form-control form-control-lg" type="text" id="city" name="city" value="{{$patient->city ??old('city')}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="city">State</label>
                                    <input class="form-control form-control-lg" type="text" id="state" name="state" value="{{$patient->state ??old('state')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="nin">National Identification Number</label>
                                    <input class="form-control form-control-lg" type="text" id="nin" name="national_id" value="{{$patient->national_id ??old('national_id')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="nin">Occupation</label>
                                    <input class="form-control form-control-lg" type="text" id="nin" name="occupation" value="{{$patient->occupation ??old('occupation')}}">
                                </div>

                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-validation2-step2" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-8">

                                        <label for="nok" class="text-bold-600 font-medium-2">
                                            Name of Next of Kin
                                        </label>
                                        <input type="text" class="form-control form-control-lg" id="nok" name="nok" value="{{ $patient->nok ?? old('nok')}}" required>

                                </div>
                                <div class="col-md-4">

                                        <label for="nok_relationship" class="text-bold-600 font-medium-2">
                                            Relationship
                                        </label>
                                        <input type="text" class="form-control form-control-lg" id="nok_relationship" name="nok_relationship" value="{{$patient->nok_relationship ?? old('nok_relationship')}}"required>
                               </div>
                                <div class="col-md-6">

                                        <label for="nok_phone" class="text-bold-600 font-medium-2">
                                            Phone
                                        </label>
                                        <input type="text" class="form-control form-control-lg required" id="nok_phone" name="nok_phone" value="{{ $patient->nok_phone ?? old('nok_phone')}}">

                                </div>
                                <input type="hidden" name="source" value="front-desk">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shortDescription3" class="text-bold-600 font-medium-2">Next of Kin Address</label>
                                        <textarea name="nok_address" id="shortDescription3" rows="4" class="form-control">{{$patient->nok_address ?? old('nok_address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-validation2-step3" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <div id="my_camera"></div>
                                    <input type=button value="Configure" onClick="configure()">
                                    <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                </div>
                                <div class="col-md-6">
                                    <div id="results"></div>
                                </div>

                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
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
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>

<script src="{{asset('backend')}}/assets/js/webcam.min.js"></script>
<script>
    $(function(){
       $('#int124').hide();

       $('#switch').click(function(){
           $('#int123').toggle();
           $('#int124').toggle();
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
