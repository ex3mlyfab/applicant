
    <div class="block rounded">
        <div class="block-header bg-info-light">
            <h3 class="block-title">Fluid Intake/Output</h3>
            <div class="block-option"><button class="btn btn-outline-primary btn-lg" data-toggle="modal"
                data-target="#fluid-block-normal">Record Fluid</button>
            </div>
        </div>
        <div class="block-content block-content-full">
                @php
                    $fluids = $inpatient->fluidReportDetails->groupBy(function($item){

                       return \Carbon\Carbon::parse($item->done_at)->format('d/M/Y H');
                    });
                @endphp
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2">
                                    time
                                </th>
                                <th colspan="2" class="bg-info-light text-center">
                                   Intake
                                </th>
                                <th colspan="2" class="bg-danger-light text-center">
                                    Output
                                </th>

                            </tr>
                            <tr >
                                <th class="bg-info-light">
                                    Type
                                </th>
                                <th class="bg-info-light">
                                    Vol. (ml)
                                </th>
                                <th class="bg-danger-light">
                                    Type
                                </th>
                                <th class="bg-danger-light">
                                    Vol.(ml)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fluids as $item => $fluid_list)
                            <tr>
                                <td>
                                    {{ $item}}:00
                                </td>
                                <td>
                                    @foreach ($fluid_list as $field)
                                        @if ($field->fluidReport->direction == 'input')
                                            <p>{{$field->fluidReport->fluid}}</p>
                                            <span class="badge badge-info">
                                                {{ \Carbon\Carbon::parse($field->done_at)->format('d/m/y H:i a')}} <br>
                                                -by {{$field->doneBy->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($fluid_list as $field)
                                        @if ($field->fluidReport->direction == 'input')
                                            <p>{{$field->measure}}</p>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($fluid_list as $field)
                                        @if ($field->fluidReport->direction == 'output')
                                            <p>{{$field->fluidReport->fluid}}</p>
                                            <span class="badge badge-danger">
                                                {{ \Carbon\Carbon::parse($field->done_at)->format('d/m/y H:i a')}} <br>
                                                -by {{$field->doneBy->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($fluid_list as $field)
                                        @if ($field->fluidReport->direction == 'output')
                                            <p>{{$field->measure}}</p>
                                        @endif
                                    @endforeach
                                </td>

                            </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>

        </div>

    </div>

