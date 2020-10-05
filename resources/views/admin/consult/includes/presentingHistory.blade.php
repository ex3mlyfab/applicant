@if ($consults->count() >= 1)
@foreach ($patient->encounters as $consult)
    @if($consult->presentingComplaints()->count())
        @foreach ($consult->presentingComplaints as $consult)
            <div class="block block-bordered">
                <div class="block-header bg-info-light">
                    <h4>Presenting Complaints History  For {{$appointment->user->full_name ?? ''}} </h4>
                    <p> recorded on {{$consult->created_at}} </p>

                </div>
                <div class="block-body">
                    <h3 class="bg-amythest">
                        {{$consult->presumptive_diagnosis }}
                    </h3>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th class="bg-info-light" style="width: 12.5%;">
                                    Presenting complaints
                                </th>
                                <th>
                                    <p>{{ $consult->pc}}</p>
                                </th>
                                <th class="bg-info-light" style="width: 12.5%;">
                                    Duration
                                </th>
                                <th>
                                    <p>{{ $consult->duration}}</p>
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-info-light">
                                    History of presenting complaints
                                </th>
                                <th colspan="3">
                                    <p>{{ $consult->pchx}}</p>
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-info-light">
                                    Past medical History :
                                </th>
                                <th colspan="3">
                                    <p>{{ $consult->pmhx}}</p>
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-info-light">
                                        Family and Social History :
                                </th>
                                <th colspan="3">
                                    <p>{{ $consult->fshx}}</p>
                                </th>
                            </tr>
                            @if ($consult->previously_admitted)
                                <tr>
                                <th class="bg-info-light">
                                        Previously Admittted for:
                                </th>
                                <th colspan="3">
                                    <p>{{ $consult->reasons4admission}}</p>
                                </th>
                            </tr>
                            @endif
                            <tr>
                                <th class="bg-info-light">
                                            History of Hypertension :
                                </th>
                                <th>
                                        <p>{{ $consult->hypertensive}}</p>
                                </th>
                                <th class="bg-info-light">
                                        History of Diabetes :
                                </th>
                                <th >
                                        <p>{{ $consult->diabetic}}</p>
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-info-light">
                                        Previous Blood transfusion :
                                </th>
                                <th>
                                        <p>{{ $consult->blood_transfusion}}</p>
                                </th>
                                <th class="bg-info-light">
                                        History of Drug/Allergy  :
                                </th>
                                <th >
                                        <p>{{ $consult->drug_or_allergy}}</p>
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-info-light">
                                        Sickle cell Disease  :
                                </th>
                                <th>
                                        <p>{{ $consult->sc_disease}}</p>
                                </th>
                                <th class="bg-info-light">
                                        Others  :
                                </th>
                                <th >
                                        <p>{{ $consult->others}}</p>
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
                                <th class="bg-info-light">
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
                                        Gastro Intestinal System (GIT)  :
                                </th>
                                <th >
                                        <p>{{ $consult->git}}</p>
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-info-light">
                                        Urinary System(US)  :
                                </th>
                                <th>
                                        <p>{{ $consult->urinary_system }}</p>
                                </th>
                                <th class="bg-info-light">
                                        Obstetrics &amps; Gynaecology (OBGYN)  :
                                </th>
                                <th >
                                        <p>{{ $consult->obgyn}}</p>
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
                    <button class="btn btn-action" id="phx">take a new History</button>
                </div>
            </div>
        @endforeach
    @endif
 @endforeach
@endif
