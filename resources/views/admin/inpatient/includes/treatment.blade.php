<div class="row bg-smooth-lighter bt-3 mt-4 p-2">
    <div class="block block-mode-hidden">
        <div class="block-header bg-danger-light">
            <h3 class="block-title">Treatment</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="py-1 text-center">
                <button type="button" class="btn btn-md btn-primary mb-2 text-uppercase" data-toggle="modal" data-target="#pharmacy-block-normal">Prescribe Drugs</button>

                <button type="button" class="btn btn-md btn-gray mb-2 text-uppercase" data-toggle="modal" data-target="#admit" {{($inpatient->procedureRequests->count())?($inpatient->procedureRequests->last()->status=='done')?:'disabled': '' }}>Operating Room</button>
                <button type="button" class="btn btn-md btn-success text-white mb-2 text-uppercase" data-toggle="modal" data-target="#treatment-block-normal">Treatment Sheet</button>
            </div>

        </div>
    </div>
    <div class="block block-mode-hidden">
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




</div>
