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
                                <div class="block">
                                    <div class="block-header bg-smooth-light">
                                        <h3 class="block-title">Investigation</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                        </div>
                                    </div>
<div class="block-content block-content-full">
                                        <div class="py-1 text-center text-uppercase">

                                            <button type="button" class="btn btn-md btn-danger w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#haematology"> Haematology </button>
                                            <button type="button" class="btn btn-md w-100 mb-2 text-white text-uppercase" data-toggle="modal" data-target="#microbiology-block-normal" style="background-color: #2cd3be;"> microbiology</button>
                                            <button type="button" class="btn btn-md btn-warning  w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#pathology"  > Chemical Pathology </button>


                                            <button type="button" class="btn btn-md w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#histology-block-normal" style="background-color: #cb9696;">Histopathology</button>
                                            <button type="button" class="btn btn-md w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#ultrasound" style="background-color: #ff9224;">Radiology</button>
                                            <button type="button" class="btn btn-md btn-danger w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#blood-block-normal">blood bank request</button>

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
                                            <button type="button" class="btn btn-md btn-primary w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#pharmacy-block-normal">Prescribe Drugs</button>
                                            <button type="button" class="btn btn-md btn-gray w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#admit">Admit</button>
                                            <button type="button" class="btn btn-md btn-success text-white w-100 mb-2 text-uppercase" data-toggle="modal" data-target="#tca">TCA</button>
                                        </div>

                                    </div>
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
                        <ul class="nav-items mb-0" id="recenttest">
                            @foreach ($consult->consultTests as $item)
                            <li class="bg-city-lighter">
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
@if ($consults->count() > 1)
    <div class="col-md-12">
        <div class="block block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Action Plan List</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                            <th>date</th>
                            <th>Date test done</th>
                            <th>Status</th>
                            <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consults as $item)
                                @if ($item->consulTests)
                                    @foreach ($item->consultTests as $item2)
                                      <tr>
                                          <td>
                                            {{$item2->created_at->diffForHumans()}}
                                          </td>
                                          <td>,
                                              {{$item2->updated_at->diffForHumans()}}
                                          </td>

                                    </tr>
                                    @endforeach


                                @endif

                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endif

</div>
