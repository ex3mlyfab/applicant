@if ($inpatient->treatmentSheets->count())
    <div class="block rounded">
        <div class="block-header bg-info-light">
            <h3 class="block-title">Treatment Sheet</h3>
        </div>
        <div class="block-content block-content-full">

                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <tbody>
                        @foreach ($inpatient->treatmentSheets as $item)
                            <tr>
                                <td>{{$item->treatment}}</td>
                                @if ($item->treatmentCharts->count())
                                @foreach ($item->treatmentCharts as $base)
                                    <td style="width: 5%">
                                        <span class="badge badge-warning">
                                            {{ \Carbon\Carbon::parse($base->done_at)->format('d/m/y H:i a')}} <br>
                                            -by {{$base->admin->name }}
                                        </span>

                                    </td>
                                @endforeach
                                @endif
                                @if (!$item->continue)
                                <td class="text-right" style="width: 5%">
                                    <button class="btn btn-primary treatment-charting" data-treatment="{{$item->treatment}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#miniverse">Mark as done</button>

                                </td>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

        </div>

    </div>
@endif
