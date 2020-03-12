 <!-- Normal Block Modal -->
 <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
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
 <!-- HaematologyBlock Modal -->
 <div class="modal" id="haematology-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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

                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END NormaHaematology Block Modal -->
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Modal Title</h3>
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                <form action="{{route('microreq.store')}}" method="post">
                        <div class="form-group">
                            <label for="specimen"> Nature of Specimen</label>
                            <input type="text" name="specimen" id="specimen" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="clinical_information"> Diagnosis and Clinical Details</label>
                            <textarea type="text" name="clinical_information" id="clinical_information" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="examination_required"> investigation required</label>
                            <input type="text" name="examination_required" id="examination_required" class="form-control form-control-lg">
                        </div>
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
<!-- END microbiology Modal -->
 <!-- Pharmacy Modal -->
 <div class="modal" id="pharmacy-block-normal" tabindex="-1" role="dialog" aria-labelledby="pharmacy-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-top" role="document" >
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">drug Request</h3>
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                    <form action="{{route('pharmreq.store') }}" method="POST" class="form form-element">
                        @csrf
                    <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="drugs">
                                <thead>
                                <th>Drug Name</th>
                                <th>Quantity</th>
                                <th>dosage</th>

                                <th style="text-align: center;background: #eee">
                                    <a href="#" onclick="addRow()">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" name="medicine[]" class="form-control form-control-lg"></td>
                                    <td><input type="text" name="quantity[]" class="form-control form-control-lg"></td>
                                    <td><input type="text" name="dosage[]" class="form-control form-control-lg"></td>


                                    <td  style="text-align: center">
                                            <a href="#" class="btn btn-success" onclick="addRow()">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                                <br>

                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
<!-- Normal Block Modal -->
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                    <form action="" method="post" class="bg-danger-light px-1">
                        @csrf
                        <div class="form-group form-row">
                            <div class="col-md-3">
                                <label for="clinical_details">Clinical Details</label>
                                <input type="text" name="clinical_details" id="clinical_details" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mt-4">
                                    <input type="checkbox" name="fbc" id="FBC" class="custom-control-input" value="fbc"><label for="FBC" class="custom-control-label">FBC</label>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="investigation_required">Investigation Required</label>
                                <input type="text" name="investigation_required" id="investigation_required" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                <tr>
                                    <td style="width:5%;" class="pr-0 mr-0">
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1">
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                        <div class="form-group">
                            <label for="clinical_information">Clinical Information</label>
                            <input type="text" name="clinical_information" id="clinical_information" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="examination_required"> investigation required</label>
                            <textarea name="examination_required" id="examination_required" class="form-control form-control-lg">
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>


                </div>
                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End Ultrasound request-->

<!-- xray Block Modal -->
<div class="modal" id="xray" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-flat text-white-75">
                    <h3 class="block-title">Radiology(<i class="fa fa-x-ray"></i> X-Ray) Request</h3>
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                        <div class="form-group">
                            <label for="clinical_information">Clinical Information</label>
                            <input type="text" name="clinical_information" id="clinical_information" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="examination_required"> investigation required</label>
                            <textarea name="examination_required" id="examination_required" class="form-control form-control-lg">
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>


                </div>
                <div class="block-content block-content-full text-right border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End xray request-->
<!-- Pathology Block Modal -->
<div class="modal" id="pathology" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-white">
                    <h3 class="block-title">Pathology &amp; Immunology</h3>
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
                                     <img src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="" class="img-avatar img-avatar96">
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
                    <form action="" method="post">
                        <div class="table-responsive">
                            <table class="table-bordered table-condensed font-size-sm" style="padding:0; margin:0;">
                                <tr>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="" name="sodium">
                                        <label for="">SODIUM<br>mmoL/l<br>135-145</label>
                                        <input type="text" name="sodium" id="">
                                    </td>



                                </tr>
                            </table>
                        </div>
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
