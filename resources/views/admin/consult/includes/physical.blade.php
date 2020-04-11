<!-- Progress Wizard 2 -->
<div class="block block-fx-pop">



    <!-- Form -->
<form action="{{route('physical.store')}}" method="POST">
        @csrf
        <!-- Steps Content -->

        <div class="block-content block-content-full tab-content px-md-5" style="min-height: 314px;">

                <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                <div class="form-group bg-city-lighter p-2">
                    <label for="firstName5">1. General Examinations </label>
                    <textarea name="general_exam" class="form-control auto-expand" rows="4" placeholder="Patient's General examination"> {{old('general_exam') ?? ''}}</textarea>

                </div>
                <div class="form-group bg-smooth-lighter p-2">
                    <label for="firstName6">2. Local Examinations </label>
                    <textarea name="local_exam" class="form-control auto-expand" rows="4" placeholder="Patient Local exam">{{old('local_exam') ?? ''}}</textarea>
                </div>
                <div class="form-group bg-amethyst-lighter p-2">
                    <label for="firstName7">3. Regional Examinations</label>
                    <textarea name="regional_exam" class="form-control auto-expand" rows="4" placeholder="Patient Regional Exam" id="firstName7">{{old('regional_exam') ?? ''}}</textarea>
                </div>
                <fieldset class="border border-info-light p-2">
                    <legend> 4. SYSTEMIC EXAMINATIONS</legend>
                    <div class="form-group form-row bg-modern-lighter p-2">
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
                        <label for="i34" class="form-control-label-lg">Respiratory System<br> (rs) </label>
                        <input type="text" name="resp_system"class="form-control form-control-lg" id="i34" placeholder="" value="{{old('resp_system') ?? ''}}">
                    </div>
                </div>
                <div class="form-group form-row bg-flat-lighter p-2">
                    <div class="col-md-4">
                        <label for="int2345" class="form-control-label-lg">Abdomen<br> &nbsp;  </label>
                        <input type="text" name="abdomen"class="form-control form-control-lg" id="int2345" placeholder="" value="{{old('abdomen') ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <label for="addressline12" class="form-control-label-lg text-center">Genito-Urinary-Tract inc. VE </label>
                        <input type="text" name="gut" class="form-control form-control-lg" id="addressline12" value="{{old('gut') ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <label for="addressline1345" class="form-control-label-lg">Skin<br> &nbsp; </label>
                        <input type="text" name="skin" class="form-control form-control-lg" id="addressline1345" {{old('skin') ?? ''}}>
                    </div>

                </div>
                <div class="form-group form-row bg-info-light p-2">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4"> <label for="addressine13" class="form-control-label-lg">MusculoSkeletal System </label>
                        <input type="text" name="musculo_skeletal" class="form-control form-control-lg" id="addressine13" value="{{old('musculo_skeletal') ?? ''}}">
                    </div>
                    <div class="col-md-4"></div>
                </div>
                </fieldset>



                <div class="form-group bg-amethyst-lighter p-2">
                    <label for="addressle12" class="text-center form-control-label-lg">Initial Diagnosis:</label>
                    <input type="text" name="initial_diagnosis" class="form-control form-control-lg " id="addressle12" required value="{{old('initial_diagnosis') ?? ''}}">
                </div>
                <div class="form-group bg-smooth-lighter p-2">
                    <label for="plan">Plan</label>
                    <textarea name="plan" id="plan"  rows="4" class="form-control">

                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>

        <!-- END Steps Navigation -->
    </form>
</div>
    <!-- END Form -->
</div>

