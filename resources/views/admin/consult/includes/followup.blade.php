<div class="block block-fx-shadow pentacare-bg">
    <div class="block-header bg-info">
        <h3 class="block-title">Follow Up Visit</h3>
    </div>
    <div class="block-content block-content-full">
    <form action="{{route('followup.store')}}" method="post">
            @csrf
    <input type="hidden" name="clinical_appointment_id" value="{{ $appointment->id }}">
    <input type="hidden" name="encounter_id" value={{$encouter->id}}>
            <div class="form-group bg-info-light p-2">
                <label class="form-control-label-lg">Subjective complaints:</label>
                <textarea name="subjective_complaints"   class="form-control" rows="5">
                    {{old('subjective_complaints') ?? ''}}
                </textarea>
            </div>
            <div class="form-group bg-amethyst-lighter p-2">
                <label class="form-control-label-lg">Objective findings</label>
                <textarea name="objective_findings"  class="form-control"  rows="5">
                    {{old('objective_findings') ?? ''}}
                </textarea>
            </div>
            <div class="form-group bg-amethyst-light p-2">
                <label >Assessment</label>
                <div class="form-check">
                    <input type="radio" name="assessment" id="Improved" class="form-check-input" value="Improved">
                    <label for="" class="form-check-label">Improved</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="assessment" id="Status_quo" class="form-check-input" value="Status_quo">
                    <label for="" class="form-check-label">Status_quo</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="assessment" id="worsened" class="form-check-input" value="Worsened">
                    <label for="" class="form-check-label">Worsened</label>
                </div>


            </div>

                <button type="submit" class="btn btn-lg btn-outline-info w-100">Submit</button>
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
