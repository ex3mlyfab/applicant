@if ($encounter->followUps->count())
<div class="block block-fx-pop">
    <div class="block-header bg-black-50">
        <h3 class="block-title">Recent Daily Monitor Record</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Subjective complaints</th>
                    <th>objective Findings</th>
                    <th>assessment</th>
                    <th> recorded by</th>
                </thead>
                <tbody>

                    @foreach ($encounter->followUps as $consult)

                            <tr>
                                <td>{{$consult->subjective_complaints}}</td>
                                <td>{{$consult->objective_findings}}</td>
                                <td>{{$consult->assessment}}</td>
                                <td>
                                    {{$consult->doneBy->name ?? ' '}}
                                    <span class="badge badge-success">
                                        {{$consult->created_at->format('d-M-Y H:i A')}}
                                    </span>
                                </td>
                            </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif


