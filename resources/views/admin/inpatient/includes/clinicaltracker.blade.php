<div class="block">
    <div class="block-header">
        <h3 class="block-title"></h3>
        <div class="block-option">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            <button type="button" class="btn mr-2 btn-md btn-primary mb-2 text-uppercase" data-toggle="modal" data-target="#clinicaltasks" > Add Clinical Tasks</button>

        </div>
    </div>
    @if ($inpatient->clinicalTrackers->count())
        <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>date</th>
                                <th>
                                    clinical tasks
                                </th>
                                <th> due date</th>
                                <th> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inpatient->clinicalTrackers as $item)
                            <tr>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{$item->created_at->format('d/M/Y H:i A')}}
                                        </span>
                                    </td>
                                <td>
                                    {{$item->clinical_tasks}}
                                </td>
                                <td>
                                    <span class="badge badge-warning">
                                        {{ \Carbon\Carbon::parse($item->due_date)->format('d/M/Y H:i a')}} <br>
                                        -by {{$item->preparedBy->name }}
                                    </span>
                                </td>

                                <td>
                                    {{($item->complete)? $item->complete: 'Not Yet Done'}}
                                    <br>
                                    @if (!($item->done))
                                        <button class="btn btn-primary clinical-task"
                                        data-complete="{{($item->complete)? $item->complete: 0}}"
                                        data-task="{{$item->clinical_tasks}}" data-id="{{$item->id}}"
                                         data-toggle="modal" data-target="#clinical-tasks-tracker">Record Activity</button>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    @endif

</div>
