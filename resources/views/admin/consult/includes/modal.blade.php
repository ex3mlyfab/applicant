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
<!-- END Normal Block Modal -->
 <!-- microbiology Modal -->
 <div class="modal" id="microbiology-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document"style=" width: 80%;">
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
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
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
    <div class="modal-dialog modal-lg" role="document" >
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
                                     <p class="my-0"> Name:<strong>{{$patient->full_name}}</strong></p>
                                    <p class="mb-0">F/No: <strong> {{$patient->folder_number}}</strong></p>
                                    <p class="mb-0">Sex:{{$patient->sex}}</p>
                                    <p>Age: {{$patient->age}}</p>

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
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
            </div>
        </div>
</div>

<!-- Pharmacy Modal -->
