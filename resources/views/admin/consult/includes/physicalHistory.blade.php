@if ($consults->count()>=1)
@foreach ($consults as $encounter)
@if($encounter->physicalExam)
<div class="block block-bordered">
    <div class="block-header bg-info-light">
        <h4>Physical Examination History  For {{$appointment->user->full_name}} </h4>
        <p> recorded on {{$encounter->physicalexam->created_at}} </p>
    </div>
    <div class="block-body">
        <h3 class="bg-aqua">
            {{$encounter->presentingcomplaint->presumptive_diagnosis }}
        </h3>
        <p>{{$encounter->presentingcomplaint->clinical_summary}}</p>
        <div class="table-responsive-lg">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th class="bg-info-light">
                            General Examination:
                        </th>
                        <th colspan="3" width="75%">
                            <p>{{ $encounter->physicalexam->general_exam}}</p>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-info-light">
                            Local Exam :
                        </th>
                        <th colspan="3">
                            <p>{{ $encounter->physicalexam->local_exam}}</p>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-info-light">
                                Regional Exam :
                        </th>
                        <th colspan="3">
                            <p>{{ $encounter->physicalexam->regional_exam}}</p>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4" class="bg-secondary">Systemic Review</th>
                    </tr>
                    <tr>
                        <th class="bg-info-light">
                                Central Nervous System(CNS)  :
                        </th>
                        <th>
                                <p>{{ $encounter->physicalexam->cns }}</p>
                        </th>
                        <th class="bg-info-light">
                                Cardio vascular System(CVS)  :
                        </th>
                        <th >
                                <p>{{ $encounter->physicalexam->cvs}}</p>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-info-light">
                                Respiratory System(RS)  :
                        </th>
                        <th>
                                <p>{{ $encounter->physicalexam->resp_system }}</p>
                        </th>
                        <th class="bg-info-light">
                                Abdomen :
                        </th>
                        <th >
                                <p>{{ $encounter->physicalexam->abdomen}}</p>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-info-light">
                                Genito-Urinary-Tract inc. VE   :
                        </th>
                        <th>
                                <p>{{ $encounter->physicalexam->gut }}</p>
                        </th>
                        <th class="bg-info-light">
                               Musculo Skeletal System :
                        </th>
                        <th >
                                <p>{{ $encounter->physicalexam->musculo_skeletal}}</p>
                        </th>
                        <th class="bg-info-light">
                                Skin :
                        </th>
                        <th >
                                <p>{{ $encounter->physicalexam->skin}}</p>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-info-light">
                                Musculo Skeletal System  :
                        </th>
                        <th>
                                <p>{{ $encounter->presentingcomplaint->mss }}</p>
                        </th>
                        <th class="bg-info-light">
                                Obstetrics &amps; Gynaecology (OBGYN)  :
                        </th>
                        <th >
                                <p>{{ $encounter->presentingcomplaint->skin }}</p>
                        </th>
                    </tr>

                </tbody>
            </table>
        </div>
        <button class="btn btn-action" id="phx">take a new History</button>
    </div>
</div>
@endif
@endforeach




@endif
