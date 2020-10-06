<div class="row gutters-tiny">
    <div class="col-md-12">
        <div class="block block-fx-shadow block-rounded">
            <div class="block-header bg-info-light">
                <h3 class="block-title">Select Actions</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-12"> <!-- Activity -->
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
                                    @foreach ($patient->encounters as $item)
                                        @foreach($item->encounterTests as $treatment)

                                            <div class="mr-3 ml-2">
                                                @switch($treatment->testable_type)
                                                    @case('App\Models\Pharmreq')
                                                        <li class="bg-default-light">
                                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                                <div class="media-body ml-3">
                                                                    <div class="font-w600">Drug Prescribed</div>
                                                                <div class="text-white">{{$treatment->status}}
                                                                    @if ($treatment->status !== 'dispensed')
                                                                        <button class="btn btn-sm btn-primary prescribe-review" data-type="{{$treatment->testable_id}}" data-model="{{$treatment->testable_type}}"
                                                                            data-toggle="modal" data-target="#pharmacy-review-block-normal">review prescrition</button>
                                                                    @endif
                                                                    </div>
                                                                    <small class="text-muted">{{$treatment->created_at->diffForHumans()}}</small>
                                                                </div>
                                                             </a>
                                                        </li>

                                                        @break
                                                    @case('App\Models\Microbiologyreq')
                                                        <li class="bg-warning">
                                                            <a class="text-dark media py-2" href="javascript:void(0)">
                                                                <div class="media-body ml-3">
                                                                    <div class="font-w600">Microbiology test requested</div>
                                                                    <div class="text-white">{{$treatment->status}}</div>
                                                                    <small class="text-muted">{{$treatment->created_at->diffForHumans()}}</small>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        @break
                                                    @default
                                                    <li class="bg-info">
                                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                                            <div class="media-body ml-3">
                                                            <div class="font-w600">{{$treatment->testable_type}}</div>
                                                                <div class="text-white">{{$treatment->status}}</div>
                                                                <small class="text-muted">{{$treatment->created_at->diffForHumans()}}</small>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endswitch

                                            </div>

                                        @endforeach
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
                            @foreach ($consult as $item)
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
