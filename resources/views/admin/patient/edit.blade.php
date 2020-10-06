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
            <div class="js-wizard-validation2 block block pentacare-bg">
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
                                <input placeholder="Enter Last name" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="wizard-validation2-lastname" name="last_name" value="{{$patient->last_name ?? old('last_name')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="wizard-validation2-firstname">Other Names</label>
                                <input placeholder="Enter Other Names" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" class="form-control form-control-lg" type="text" id="wizard-validation2-othername" name="other_names" value="{{$patient->other_names ?? old('other_names')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="wizard-validation2-phone">Phone Number</label>
                                    <input class="form-control form-control-lg" placeholder="Enter Phone Number" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="number" id="wizard-validation2-phone" name="phone" value="{{$patient->phone ?? old('phone')}}" required>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-sm-4 mb-2">
                                    <label for="select-religion">Religion</label>
                                    <select class="form-control form-control-lg" type="text" id="select-religion" name="religion" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" required>
                                        <option value="">Choose One...</option>
                                        <option value="Islam" {{ $patient->religion =='Islam' || (old('religion')=='Islam') ? 'selected' :''}}>Islam</option>
                                        <option value="Christianity" {{ $patient->religion =='Christianity' || old('religion')=='Christianity' ? 'selected':''}}>Christianity</option>
                                        <option value="Traditional" {{ $patient->religion =='Traditional' || old('religion')=='Traditional' ? 'selected':''}}>Traditional</option>
                                        <option value="Others" {{ old('religion')=='Others' ? 'selected':''}}>Others</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="select-sex">Sex</label>
                                    <select class="form-control form-control-lg" type="text" id="select-sex" name="sex" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" required>
                                        <option value="">Choose One...</option>
                                        <option value="Male" {{ $patient->sex =='Male' || (old('sex')=='Male') ? 'selected' :''}}>Male</option>
                                        <option value="Female" {{ $patient->sex =='Female' || old('sex')=='Female' ? 'selected':''}}>Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="select-marriage">Marital Status</label>
                                    <select class="form-control form-control-lg" type="text" id="select-marriage" name="marital_status" style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" required>
                                        <option value="">Choose One...</option>
                                        <option value="Never Married" {{ $patient->marital_status =='Never Married' || old('marital_status')=='Never Married' ? 'select':''}}>Never Married(single)</option>
                                        <option value="Married" {{ $patient->marital_status =='Married' || old('marital_status')=='Married' ? 'selected':''}}>Married</option>
                                        <option value="Widowed" {{$patient->marital_status =='Widowed' || old('marital_status')=='Widowed' ? 'selected':''}}>Widowed</option>
                                        <option value="divorced" {{ $patient->marital_status =='divorced' ||  old('marital_status')=='divorced' ? 'selected':''}}>Divorced</option>

                                    </select>
                                </div>
                                    <div class="col-sm-4">
                                        <label for="email">Email</label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter your Email Address" class="form-control form-control-lg" type="email" id="email" name="email" value="{{ $patient->email ?? old('email')}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            Date of Birth :
                                        </label><a href="#" id="switch">estimated age? click</a>

                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa"  type="text" class="p-2 js-datepicker form-control p-2 mt-2" id="int123" name="dob" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"
                                    value="{{  \Carbon\Carbon::parse( $patient->dob)->format('d/M/Y')  ?? \Carbon\Carbon::parse( old('dob'))->format('d/M/Y') }}" required>
                                    <input type="text"  name="age_at_reg" class="form-control form-control-lg p-2" id="int124" placeholder="Enter estimated Age" value="{{ $patient->age_at_reg ?? old('age_at_reg')}}" required>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                    <label for="nin">Nationality</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the Nationality" class="form-control form-control-lg" type="text" id="nin" name="national_id" value="{{$patient->nationality ?? old('nationality')}}" required>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-sm-4 mb-2">
                                    <label for="address">Address</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the Address" class="form-control form-control-lg" id="address" name="address" value="{{$patient->address ?? old('address')}}" required>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="city">City</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the City" class="form-control form-control-lg" type="text" id="city" name="city" value="{{$patient->city ?? old('city')}}" required>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="city">State</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the State of Origin" class="form-control form-control-lg" type="text" id="state" name="state" value="{{ $patient->state ?? old('state')}}" required>
                                </div>


                                <div class="col-sm-4 mb-2">
                                    <label for="tribe">TRIBE</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the Tribe" class="form-control form-control-lg" type="text" id="tribe" name="tribe" value="{{$patient->tribe ??  old('tribe')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="occupation">Occupation</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the Occupation" class="form-control form-control-lg" type="text" id="occupation" name="occupation" value="{{$patient->occupation ??  old('occupation')}}" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="referral_source">Referral Source</label>
                                    <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" placeholder="Enter the Referral Source" class="form-control form-control-lg" type="text" id="referral_source" name="referral_source" value="{{$patient->referral_source ?? old('referral_source')}}">
                                </div>

                            </div>

                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-validation2-step2" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-12">

                                        <label for="nok" class="text-bold-600 font-medium-2">
                                            Name of Next of Kin
                                        </label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" class="form-control form-control-lg" id="nok" name="nok" value="{{ $patient->nok ?? old('nok')}}" required>

                                </div>
                                <div class="col-md-12 mt-2">

                                        <label for="nok_relationship" class="text-bold-600 font-medium-2">
                                            Relationship
                                        </label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" class="form-control form-control-lg" id="nok_relationship" name="nok_relationship" value="{{$patient->nok_relationship ?? old('nok_relationship')}}"required>
                               </div>
                                <div class="col-md-12 mt-2">

                                        <label for="nok_phone" class="text-bold-600 font-medium-2">
                                            Phone
                                        </label>
                                        <input style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" type="text" class="form-control form-control-lg required" id="nok_phone" name="nok_phone" value="{{ $patient->nok_phone ?? old('nok_phone')}}">

                                </div>
                                <input type="hidden" name="source" value="front-desk">

                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label for="shortDescription3" class="text-bold-600 font-medium-2">Next of Kin Address</label>
                                        <textarea style="border: 1.5px solid rgb(51, 70, 128); background: #fafafa" name="nok_address" id="shortDescription3" rows="4" class="form-control">{{$patient->nok_address ?? old('nok_address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-validation2-step3" role="tabpanel">
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <div style="width: 500px; height: 300px" id="my_camera" class="mt-3 d-flex justify-content-center text-center"></div>
                                    <input id="startCamera" class="btn btn-primary mt-2" type="button" value="Configure" onClick="configure()">
                                    <input id="takeCamera" class="btn btn-primary mt-2" type="button" value="Take Snapshot" onClick="take_snapshot()">
                                </div>
                                <div class="col-md-6">
                                    <div style="width: 500px; height: 300px" class="mt-3" id="results"></div>
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
                                <button class="btn text-white d-flex btn-secondary" type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i style="font-size: 23px;" class="bx bx-chevrons-left bx-fade-right ml-2" class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn text-white d-flex ml-auto" style="background: rgb(51, 70, 128)" type="button" class="btn btn-secondary" data-wizard="next">
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
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>

<script src="{{asset('backend')}}/assets/js/webcam.min.js"></script>
<script>

$('#takeCamera').hide(300);

$('#startCamera').click(() => {
    $('#takeCamera').show(300);
    $('#startCamera').hide(300)
})


$('#takeCamera').click(() => {
    $('#startCamera').show(300);
    $('#takeCamera').hide(300)
})

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
         width: 500,
         height: 300,
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
