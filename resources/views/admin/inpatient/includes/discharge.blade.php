<h3 class="text-uppercase text-center bg-modern text-white">Doctor's Discharge Summary</h3>
@foreach ($inpatient->dischargeSummaries as $item)
    @if ($item->professional == 'doctor')
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Discharge Summary </h3>
            </div>
            <div class="block-content block-content-full">
                <h3 class="text-uppercase bg-dark text-white"> Condition</h3>
            <p class="text-muted">{{$item->status}}</p>
                <h3 class="text-uppercase bg-dark text-white"> Summary</h3>
            <p class="text-muted">{{$item->discharge_summary}}</p>
            <p>{{$item->doneBy->name}}-{{$item->created_at->format('d-M-Y H:i A')}}</p>
            </div>
        </div>
    @endif
@endforeach
<h3 class="text-uppercase text-center bg-modern text-white">Doctor's Discharge Summary</h3>
@foreach ($inpatient->dischargeSummaries as $item)
    @if ($item->professional == 'nurse')
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Discharge Summary </h3>
            </div>
            <div class="block-content block-content-full">
                <h3 class="text-uppercase bg-dark text-white"> Condition</h3>
            <p class="text-muted">{{$item->status}}</p>
                <h3 class="text-uppercase bg-dark text-white"> Summary</h3>
            <p class="text-muted">{{$item->discharge_summary}}</p>
            <p>{{$item->doneBy->name}}-{{$item->created_at->format('d-M-Y H:i A')}}</p>
            </div>
        </div>
    @endif
@endforeach
