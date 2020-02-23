<!-- Progress Wizard 2 -->
<div class="js-wizard-simple block block">

    <!-- Step Tabs -->
    <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#wizard-progress2-1" data-toggle="tab">1. General Examinations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#wizard-progress2-2" data-toggle="tab">2. Local Examinations</a>
        </li>

    </ul>
    <!-- END Step Tabs -->

    <!-- Form -->
<form action="{{route('physical.store')}}" method="POST">
        @csrf
        <!-- Steps Content -->
        <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
        <div class="block-content block-content-full tab-content px-md-5" style="min-height: 314px;">
            <!-- Step 1 -->
            <div class="tab-pane active" id="wizard-progress2-1" role="tabpanel">
                <div class="form-group">
                    <label for="firstName5">1. General Examinations </label>
                    <textarea name="general_exam" class="form-control auto-expand" rows="4" placeholder="Patient's General examination"> {{old('general_exam') ?? ''}}</textarea>

                </div>
                <div class="form-group">
                    <label for="firstName6">2. Local Exam </label>
                    <textarea name="local_exam" class="form-control auto-expand" rows="4" placeholder="Patient Local exam">{{old('local_exam') ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="firstName7">3. Regional Exam</label>
                    <textarea name="regional_exam" class="form-control auto-expand" rows="4" placeholder="Patient Regional Exam" id="firstName7">{{old('regional_exam') ?? ''}}</textarea>
                </div>
            </div>
            <!-- END Step 1 -->

            <!-- Step 2 -->
            <div class="tab-pane" id="wizard-progress2-2" role="tabpanel">
                <div class="form-group form-row">
                    <div class="col-md-4">
                        <label for="int12" class="form-control-label-lg">Central Nervous System(CNS) :</label>
                        <input type="text" name="cns" class="form-control form-control-lg" id="int12"
                        value="{{old('cns') ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <label for="in234" class="form-control-label-lg">cardio-vascular System (cvs) </label>
                        <input type="text" name="cvs"class="form-control form-control-lg" id="in234" placeholder="" value="{{old('cvs') ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <label for="i34" class="form-control-label-lg">Respiratory System (rs) </label>
                        <input type="text" name="resp_system"class="form-control form-control-lg" id="i34" placeholder="" value="{{old('resp_system') ?? ''}}">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-4">
                        <label for="int2345" class="form-control-label-lg">Abdomen  </label>
                        <input type="text" name="abdomen"class="form-control form-control-lg" id="int2345" placeholder="" value="{{old('abdomen') ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <label for="addressline12" class="form-control-label-lg">Genito-Urinary-Tract inc. VE :</label>
                        <input type="text" name="gut" class="form-control form-control-lg" id="addressline12" value="{{old('gut') ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <label for="addressline1345" class="form-control-label-lg">Skin:</label>
                        <input type="text" name="skin" class="form-control form-control-lg" id="addressline1345" {{old('skin') ?? ''}}>
                    </div>

                </div>
                <div class="form-group form-row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4"> <label for="addressine13" class="form-control-label-lg">MusculoSkeletal System :</label>
                        <input type="text" name="musculo_skeletal" class="form-control form-control-lg" id="addressine13" value="{{old('musculo_skeletal') ?? ''}}"></div>
                    <div class="col-md-4"></div>
                </div>
                <div class="form-group">
                    <label for="addressle12" class="text-center form-control-label-lg">Initial Diagnosis:</label>
                    <input type="text" name="initial_diagnosis" class="form-control form-control-lg " id="addressle12" required value="{{old('initial_diagnosis') ?? ''}}">
                </div>
            </div>
            <!-- END Step 2 -->


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
