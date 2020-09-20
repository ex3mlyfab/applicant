@if ($inpatient->user->consults->count()>=1)
@foreach ($inpatient->user->encounters as $tree)
    @if($tree->physicalExams()->count())
        @foreach ($tree->physicalExams as $consult)
            <div class="block block-bordered">
                <div class="block-header bg-info-light">
                    <h4>Physical Examination History  For {{$inpatient->user->full_name}} </h4>
                    <p> recorded on {{$consult->created_at}} </p>
                </div>
                <div class="block-body">
                    <h3 class="bg-aqua">
                        Presumptive Diagnosis
                    </h3>
                    <p>{{$tree->presentingcomplaints()->first()->presumptive_diagnosis}}</p>
                    <div class="table-responsive-lg">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th class="bg-info-light" style="width: 12.5%;">
                                        General Examination:
                                    </th>
                                    <th colspan="3">
                                        <p>{{ $consult->general_exam}}</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                        Local Exam :
                                    </th>
                                    <th colspan="3">
                                        <p>{{ $consult->local_exam}}</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                            Regional Exam :
                                    </th>
                                    <th colspan="3">
                                        <p>{{ $consult->regional_exam}}</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="bg-secondary text-white">Systemic Review</th>
                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                            Central Nervous System(CNS)  :
                                    </th>
                                    <th>
                                            <p>{{ $consult->cns }}</p>
                                    </th>
                                    <th class="bg-info-light" style="width: 12.5%;">
                                            Cardio vascular System(CVS)  :
                                    </th>
                                    <th >
                                            <p>{{ $consult->cvs}}</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                            Respiratory System(RS)  :
                                    </th>
                                    <th>
                                            <p>{{ $consult->resp_system }}</p>
                                    </th>
                                    <th class="bg-info-light">
                                            Abdomen :
                                    </th>
                                    <th >
                                            <p>{{ $consult->abdomen}}</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                            Genito-Urinary-Tract inc. VE   :
                                    </th>
                                    <th>
                                            <p>{{ $consult->gut }}</p>
                                    </th>
                                    <th class="bg-info-light">
                                        Musculo Skeletal System :
                                    </th>
                                    <th >
                                            <p>{{ $consult->musculo_skeletal}}</p>
                                    </th>

                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                        Skin :
                                </th>
                                <th >
                                        <p>{{ $consult->skin}}</p>
                                </th>
                                </tr>
                                <tr>
                                    <th class="bg-info-light">
                                            Musculo Skeletal System  :
                                    </th>
                                    <th>
                                            <p>{{ $consult->mss }}</p>
                                    </th>
                                    <th class="bg-info-light">
                                            Obstetrics &amps; Gynaecology (OBGYN)  :
                                    </th>
                                    <th >
                                            <p>{{ $consult->skin }}</p>
                                    </th>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-action" id="physical">Take a new Physical Exam</button>
                </div>
            </div>
        @endforeach
    @endif
@endforeach




@endif
