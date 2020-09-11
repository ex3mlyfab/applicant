<!-- Progress Wizard 2 -->
<div class="block block-fx-pop pentacare-bg">



    <!-- Form -->
<form action="{{route('physical.store')}}" method="POST">
        @csrf
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
                <fieldset class="p-2" >
                    <legend class="text-white"> 4. SYSTEMIC EXAMINATIONS</legend>
                    <div class="form-group form-row p-2 text-white" style="background: rgb(51, 70, 128)">
                    <div class="col-md-6">
                        <label for="int12" class="form-control-label-lg text-white">Central Nervous System(CNS) :</label>
                        <input type="text" name="cns" class="form-control form-control-lg" id="int12"
                        value="{{old('cns') ?? ''}}">
                    </div>
                    <div class="col-md-6">
                        <label for="in234" class="form-control-label-lg text-white">cardio-vascular System (cvs) </label>
                        <input type="text" name="cvs"class="form-control form-control-lg" id="in234" placeholder="" value="{{old('cvs') ?? ''}}">
                    </div>
                </div>
                <div class="form-group form-row p-2" style="background: rgb(111, 134, 202)">
                    <div class="col-md-6">
                        <label for="int2345" class="form-control-label-lg text-white">Abdomen<br> &nbsp;  </label>
                        <textarea name="abdomen" class="form-control form-control-lg" id="addressine13" value="{{old('abdomen') ?? ''}}"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="i34" class="form-control-label-lg text-white">Respiratory System<br> (rs) </label>
                        <textarea name="resp_system" class="form-control form-control-lg" id="addressine13" value="{{old('resp_system') ?? ''}}"></textarea>
                    </div>
                </div>
                <div class="form-group form-row p-2" style="background: rgb(95, 177, 202)">
                    <div class="col-md-6">
                        <label for="addressline12" class="form-control-label-lg text-center text-white">Genito-Urinary-Tract inc. VE </label>
                        <textarea name="gut" class="form-control form-control-lg" id="addressine13" value="{{old('gut') ?? ''}}"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="addressline1345" class="form-control-label-lg text-white">Skin </label>
                        <textarea name="skin" class="form-control form-control-lg" id="addressine13" value="{{old('skin') ?? ''}}"></textarea>
                    </div>
                </div>

                <div class="form-group form-row bg-info-light p-2">
                    <div class="col-md-12"> <label for="addressine13" class="form-control-label-lg">MusculoSkeletal System </label>
                    <textarea name="musculo_skeletal" class="form-control form-control-lg" id="addressine13" value="{{old('musculo_skeletal') ?? ''}}"></textarea>
                    </div>
                </fieldset>



                <div class="form-group bg-amethyst-lighter p-2">
                    <label for="addressle12" class="text-center form-control-label-lg">Initial Diagnosis:</label>
                    <input type="text" name="initial_diagnosis" class="form-control form-control-lg " id="addressle12" required value="{{old('initial_diagnosis') ?? ''}}">
                </div>
                <div class="form-group bg-smooth-lighter p-2">
                    <label for="plan" class="text-white">Plan</label>
                    <div class="d-flex pl-2 pr-2">
                        <button type="button" class="btn mr-2 btn-md btn-danger w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#haematology"> Haematology </button>
                        <button type="button" class="btn mr-2 btn-md w-100 mb-2 text-white text-uppercase" data-toggle="modal" data-target="#microbiology-block-normal" style="background-color: #2cd3be;"> microbiology</button>
                        <button type="button" class="btn mr-2 btn-md btn-warning  w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#pathology"  > Chemical Pathology </button>
                        <button type="button" class="btn mr-2 btn-md w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#histology-block-normal" style="background-color: #cb9696;">Histopathology</button>
                        <button type="button" class="btn mr-2 btn-md w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#ultrasound" style="background-color: #ff9224;">Radiology</button>
                        <button type="button" class="btn btn-md btn-danger w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#blood-block-normal">blood bank request</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
</div>

