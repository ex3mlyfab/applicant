<h3 class="text-uppercase text-center bg-modern text-white">Discharge Summary</h3>
@foreach ($inpatient->dischargeSummaries as $item)

        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title text-center">Discharge Summary </h3>
            </div>
            <div class="block-content block-content-full">
                <h3 class="text-uppercase bg-dark text-white text-center"> Condition</h3>
            <p class="text-muted mr-2">{{$item->status}}</p>
                <h3 class="text-uppercase bg-dark text-white text-center"> Summary</h3>
            <p class="text-muted mr-2">{{$item->discharge_summary}}</p>
            <p class="bg-secondary text-white">Signed by: &nbsp; {{$item->doneBy->name}}-{{$item->created_at->format('d-M-Y H:i A')}}</p>
            </div>
        </div>

@endforeach

