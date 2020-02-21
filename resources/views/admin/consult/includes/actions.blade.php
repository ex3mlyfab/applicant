<div class="row gutters-tiny">
    <div class="col-md-6">
        <div class="block block-fx-shadow block-rounded">
            <div class="block-header bg-info-light">
                <h3 class="block-title">Select Actions</h3>
            </div>
            <div class="block-content block-content-full">
                 <!-- Activity -->
                 <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Recent Activity</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- Activity List -->
                        <ul class="nav-items mb-0">
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-3 ml-2">
                                        <i class="si si-wallet text-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-w600">New sale ($15)</div>
                                        <div class="text-success">Admin Template</div>
                                        <small class="text-muted">3 min ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-3 ml-2">
                                        <i class="si si-pencil text-info"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-w600">You edited the file</div>
                                        <div class="text-info">
                                            <i class="fa fa-file-text"></i> Documentation.doc
                                        </div>
                                        <small class="text-muted">15 min ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-3 ml-2">
                                        <i class="si si-close text-danger"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-w600">Project deleted</div>
                                        <div class="text-danger">Line Icon Set</div>
                                        <small class="text-muted">4 hours ago</small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- END Activity List -->
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-primary push" data-toggle="modal" data-target="#modal-block-normal">Launch Modal</button>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="block block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Active Action Plan List</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <th>s/No</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
 <!-- Normal Block Modal -->
 <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
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
<!-- END Normal Block Modal -->
