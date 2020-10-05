@if ($inpatient->user->encounters->count())
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
                    @foreach ($inpatient->user->encounters as $consult)
                        @if ($consult->followUps->count())
                            <tr>
                                <td>{{$consult->followUps->last()->subjective_complaints}}</td>
                                <td>{{$consult->followUps->last()->objective_findings}}</td>
                                <td>{{$consult->followUps->last()->assessment}}</td>

                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@if ($inpatient->user->consults->count() > 2)
    <div class="block block-fx-pop">
    <div class="block-header bg-black-50">
        <h3 class="block-title">previous Follow up visit</h3>
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

                    @foreach ($inpatient->user->encounters as $consult)

                        @if($consult->followUp)
                            <tr>
                                <td>{{$consult->followUp->subjective_complaints}}</td>
                                <td>{{$consult->followUp->objective_findings}}</td>
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

