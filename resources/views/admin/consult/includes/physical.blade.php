<!-- Progress Wizard 2 -->
<div class="block block-fx-pop pentacare-bg">



    <!-- Form -->
<form action="{{route('physical.store')}}" method="POST">
        @csrf
        <div class="block-content block-content-full tab-content px-md-5" style="min-height: 314px;">

                <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                <input type="hidden" name="encounter_id" value={{$encounter->id}}>
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

                <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fa fa-2x fa-save"></i> Submit</button>
    </form>
    <div class="row bg-smooth-lighter bt-3 mt-4 p-2">

        <div class="block">
            <div class="block-header bg-amethyst">
                <h3 class="block-title">Plan</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="py-1 text-center">
                     <button type="button" class="btn mr-2 btn-md btn-danger mb-2 text-uppercase" data-toggle="modal" data-target="#haematology"> Haematology </button>
                    <button type="button" class="btn mr-2 btn-md mb-2 text-white text-uppercase" data-toggle="modal" data-target="#microbiology-block-normal" style="background-color: #2cd3be;"> microbiology</button>
                    <button type="button" class="btn mr-2 btn-md btn-warning  mb-2 text-uppercase" data-toggle="modal" data-target="#pathology"  > Chemical Pathology </button>
                    <button type="button" class="btn mr-2 btn-md mb-2 text-uppercase" data-toggle="modal" data-target="#histology-block-normal" style="background-color: #cb9696;">Histopathology</button>
                    <button type="button" class="btn mr-2 btn-md mb-2 text-uppercase" data-toggle="modal" data-target="#ultrasound" style="background-color: #ff9224;">Radiology</button>
                    <button type="button" class="btn btn-md btn-danger mb-2 text-uppercase" data-toggle="modal" data-target="#blood-block-normal">blood bank request</button>
                        </div>
            </div>
        </div>



        <div class="block">
            <div class="block-header bg-danger-light">
                <h3 class="block-title">Treatment</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="py-1 text-center">
                    <button type="button" class="btn btn-md btn-primary mb-2 text-uppercase" data-toggle="modal" data-target="#pharmacy-block-normal">Prescribe Drugs</button>
                    <button type="button" class="btn btn-md btn-gray mb-2 text-uppercase" data-toggle="modal" data-target="#admit">Admit</button>
                    <button type="button" class="btn btn-md btn-success text-white mb-2 text-uppercase" data-toggle="modal" data-target="#tca">TCA</button>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

