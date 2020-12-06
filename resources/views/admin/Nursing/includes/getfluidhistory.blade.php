
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

                   return \Carbon\Carbon::parse($item->done_at)->format('d/M/Y');
                } );
            @endphp
            <div class="table-responsive">
                <table class="js-table-sections table table-hover table-vcenter table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">

                            </th>
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

                        @foreach ($fluids as $item => $fluid_list)
                        <tbody class="js-table-sections-header {{($loop->first?'show table-active': '')}} ">
                            <tr class="bg-dark text-white text-center">

                                    <td class="text-center">
                                        <i class="fa fa-angle-right text-muted"></i>
                                    </td>

                                <td>
                                    {{ $item}}   Daily Total
                                </td>
                                <td>
                                   Input
                                </td>
                                <td>
                                    {{$fluid_list->filter(function($item){
                                        return $item->fluidReport->direction == 'input';
                                    })->sum('measure')
                                    }}
                                </td>
                                <td>
                                    Output
                                </td>
                                <td>
                                    {{$fluid_list->filter(function($item){
                                        return $item->fluidReport->direction == 'output';
                                    })->sum('measure')
                                    }}
                                </td>
                            </tr>

                    </tbody>
                    <tbody class="font-size-sm">
                        <tr>
                            <td></td>
                            <td>
                                {{ $item}}

                            </td>
                            <td>
                                @foreach ($fluid_list as $item)
                                    @if ($item->fluidReport->direction == 'input')
                                        <p class="mb-0">{{$item->fluidReport->fluid}}</p>
                                        <span class="badge badge-info mt-0">
                                            {{ \Carbon\Carbon::parse($item->done_at)->format('d/m/y H:i a')}} <br>
                                            -by {{$item->doneBy->name }}
                                        </span>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($fluid_list as $item)
                                    @if ($item->fluidReport->direction == 'input')
                                        <p>{{$item->measure}}</p>
                                        <br>

                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($fluid_list as $item)
                                    @if ($item->fluidReport->direction == 'output')
                                        <p class="mb-0">{{$item->fluidReport->fluid}}</p>
                                        <span class="badge badge-danger mt-0">
                                            {{ \Carbon\Carbon::parse($item->done_at)->format('d/m/y H:i a')}} <br>
                                            -by {{$item->doneBy->name }}
                                        </span>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($fluid_list as $item)
                                    @if ($item->fluidReport->direction == 'output')
                                        <p>{{$item->measure}}</p>
                                        <br>

                                    @endif
                                @endforeach
                            </td>

                        </tr>
                        </tbody>
                        @endforeach


                </table>

            </div>

    </div>

    </div>

