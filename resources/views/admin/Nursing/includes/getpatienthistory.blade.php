@if ($inpatient->nursingHistoryTaking->count())
   <div class="block block-fx-shadow">
        <div class="block-header">
            <h3 class="block-title">Patient Health History</h3>
            <div class="block-option">
                <button id="open-health" class="btn btn-primary">take new health history</button>
            </div>
        </div>
        <div class="block-content block-contentful">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <th>Past Health History</th>
                        <th>present Health History</th>
                        <th>Recorded by</th>
                    </thead>
                    <tbody>
                        @foreach ($inpatient->nursingHistoryTaking as $item)
                           <tr>
                           <td>{{$item->past_health_history}}</td>
                           <td>{{$item->present_health_history}}</td>
                           <td>{{$item->admin->name}}</td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endif
