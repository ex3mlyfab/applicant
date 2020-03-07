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
