<div class="row gutters-tiny">
    <div class="col-md-12">
        <div class="block block-fx-shadow block-rounded">
            <div class="block-header bg-info-light">
                <h3 class="block-title">Select Actions</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-5">
                        <div class="block invisible"  data-toggle="appear">
                            <div class="block-content block-content-full">
                                <div class="py-3 text-center">

                                    <button type="button" class="btn btn-sm btn-danger w-100 mb-2" data-toggle="modal" data-target="#haematology"> Haematology request</button>
                                    <button type="button" class="btn btn-sm w-100 mb-2 text-white-50" data-toggle="modal" data-target="#microbiology-block-normal" style="background-color: #2cd3be;"> microbiology Test</button>
                                    <button type="button" class="btn btn-sm btn-warning w-100 mb-2" data-toggle="modal" data-target="#pathology"> Chemical Pathology </button>


                                    <button type="button" class="btn btn-sm btn-smooth w-100 mb-2" data-toggle="modal" data-target="#ultrasound">Radiology(Ultrasound) Test</button>
                                    <button type="button" class="btn btn-sm btn-smooth w-100 mb-2" data-toggle="modal" data-target="#xray">Radiology( <i class="fa fa-x-ray"></i> X-Ray) Test</button>


                                    <button type="button" class="btn btn-sm btn-danger w-100 mb-2" data-toggle="modal" data-target="#blood-block-normal">Serotology request</button>
                                    <button type="button" class="btn btn-sm btn-primary w-100 mb-2" data-toggle="modal" data-target="#pharmacy-block-normal">Prescribe Drugs</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7"> <!-- Activity -->
                 <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Recent Action plan</h3>
                        <div class="block-options">

                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- Activity List -->
                        <ul class="nav-items mb-0">
                            @foreach ($consult->consultTests as $item)
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-3 ml-2">

                                    </div>
                                    <div class="media-body">
                                        <div class="font-w600">{{ $item->type}}</div>
                                        <div class="text-success">{{$item->status}}</div>
                                        <small class="text-muted">{{$item->created_at->diffForHumans()}}</small>
                                    </div>
                                </a>
                            </li>
                            @endforeach


                        </ul>
                        <!-- END Activity List -->
                    </div>
                </div>
            </div>


            </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="block block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Action Plan List</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <th>s/No</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
