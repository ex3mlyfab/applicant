<div class="block rounded b">
    <div class="block-header bg-info-light">
        <h3 class="block-title">Nursing Reports</h3>

    </div>
    <div class="block-content block-content-full">
        @foreach ($inpatient->nursingReports as $item)
        <div class="block block-themed mb-2 border-1">
            <div class="block-header">
            <h3 class="block-title text-center">{{$item->created_at->format('d/M/Y')}}-{{$item->duty}} -by {{$item->admin->name}}</h3>
            </div>
            <div class="block-content bg-gray-lighter">
            <p>{{$item->report}}</p>
            </div>
        </div>
        @endforeach
    </div>

</div>
