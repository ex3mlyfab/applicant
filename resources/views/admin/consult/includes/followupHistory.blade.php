@if ($encounter->followUps->count())
<div class="block block-fx-pop">
    <div class="block-header bg-black-50">
        <h3 class="block-title">Recent Follow Up Record</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Subjective complaints</th>
                    <th>objective Findings</th>
                    <th>assessment</th>
                </thead>
                <tbody>

                    @foreach ($encounter->followUps as $consult)

                            <tr>
                                <td>{{$consult->subjective_complaints}}</td>
                                <td>{{$consult->objective_findings}}</td>
                                <td>{{$consult->assessment}}</td>
                            </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
@if ($consults->count() > 2)
    <div class="block block-fx-pop">
    <div class="block-header bg-black-50">
        <h3 class="block-title">Previous Follow up visit</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Subjective complaints</th>
                    <th>objective Findings</th>
                    <th>assessment</th>
                </thead>
                <tbody>

                    @foreach ($consults as $consult)
                        @if($consult->followUp)
                            <tr>
                                <td>{{$consult->followUp->subjective_complaints}}</td>
                                <td>{{$consult->followUp->objective_finding}}</td>
                                <td>{{$consult->followUp->assessment}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

