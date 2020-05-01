@if ($consults->count() >= 1)
@foreach ($consults as $consult)


    @if($consult->presentingComplaint)





<div class="block block-bordered">
    <div class="block-header bg-info-light">
        <h4>Physical Examination History  For {{$appointment->user->full_name ?? ''}} </h4>

    </div>
    <div class="block-body">
        <h3 class="bg-amythest">
            {{$consult->presentingComplaint->presumptive_diagnosis }}
        </h3>

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th class="bg-info-light">
                        History of presenting complaints
                    </th>
                    <th colspan="3">
                        <p>{{ $consult->presentingComplaint->pchx}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                        Past medical History :
                    </th>
                    <th colspan="3">
                        <p>{{ $consult->presentingComplaint->pmhx}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                            Family and Social History :
                    </th>
                    <th colspan="3">
                        <p>{{ $consult->presentingComplaint->fshx}}</p>
                    </th>
                </tr>
                @if ($consult->presentingComplaint->previously_admitted)
                    <tr>
                    <th class="bg-info-light">
                             Previously Admittted for:
                    </th>
                    <th colspan="3">
                        <p>{{ $consult->presentingComplaint->reasons4admission}}</p>
                    </th>
                </tr>
                @endif
                <tr>
                    <th class="bg-info-light">
                                 History of Hypertension :
                    </th>
                    <th>
                            <p>{{ $consult->presentingComplaint->hypertensive}}</p>
                    </th>
                    <th class="bg-info-light">
                            History of Diabetes :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->diabetic}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                            Previous Blood transfusion :
                    </th>
                    <th>
                            <p>{{ $consult->presentingComplaint->blood_transfusion}}</p>
                    </th>
                    <th class="bg-info-light">
                            History of Drug/Allergy  :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->drug_or_allergy}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                            Sickle cell Disease  :
                    </th>
                    <th>
                            <p>{{ $consult->presentingComplaint->sc_disease}}</p>
                    </th>
                    <th class="bg-info-light">
                            Others  :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->others}}</p>
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
                            <p>{{ $consult->presentingComplaint->cns }}</p>
                    </th>
                    <th class="bg-info-light">
                            Cardio vascular System(CVS)  :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->cvs}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                            Respiratory System(RS)  :
                    </th>
                    <th>
                            <p>{{ $consult->presentingComplaint->resp_system }}</p>
                    </th>
                    <th class="bg-info-light">
                            Gastro Intestinal System (GIT)  :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->git}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                            Urinary System(US)  :
                    </th>
                    <th>
                            <p>{{ $consult->presentingComplaint->urinary_system }}</p>
                    </th>
                    <th class="bg-info-light">
                            Obstetrics &amps; Gynaecology (OBGYN)  :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->obgyn}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="bg-info-light">
                            Musculo Skeletal System  :
                    </th>
                    <th>
                            <p>{{ $consult->presentingComplaint->mss }}</p>
                    </th>
                    <th class="bg-info-light">
                            Obstetrics &amps; Gynaecology (OBGYN)  :
                    </th>
                    <th >
                            <p>{{ $consult->presentingComplaint->skin }}</p>
                    </th>
                </tr>

            </tbody>
        </table>
        <button class="btn btn-action" id="phx">take a new History</button>
    </div>
</div>




    @endif
 @endforeach
@endif
