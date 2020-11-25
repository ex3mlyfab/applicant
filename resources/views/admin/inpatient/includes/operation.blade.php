@foreach ($inpatient->user->encounters as $item)
    @if ($item->operatingRooms->count())
        @foreach ($item->operatingRooms as $report)
           <div class="block">
       <div class="block-header">
           <h3 class="block-title">
               done on {{$report->created_at->format('d/M/Y')}}
           </h3>

       </div>
       <div class="block-content">
        <h3 class="block-title text-center bg-dark text-white">Operation Report</h3>
            <div class="row" style="border: 1px solid #000;">
                <div class="col-md-4">
                    <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Operation Name :</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ ucfirst($report->operation_name)}}</p>
                                </div>
                            </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Position</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ ucfirst($report->position)}}</p>
                                </div>
                            </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Incision</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ ucfirst($report->incision)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Pre operative pcv</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ $report->pre_operative_pcv}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Findings</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ ucfirst($report->findings)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Procedure</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ ucfirst($report->procedure)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offset-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Estimated blood Loss</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ $report->estimated_blood_loss}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Lead Surgeon</h3>
                        </div>
                        <div class="block-content text-uppercase">
                            <p>{{ $report->lead_surgeon}}</p>
                        </div>
                    </div>
                </div>
            </div>
       </div>
   </div>
        @endforeach
    @endif

@endforeach
