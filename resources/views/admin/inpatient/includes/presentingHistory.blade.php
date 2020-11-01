@if ($inpatient->user->encounters->count() >= 1)
@foreach ($inpatient->user->encounters as $consult)
    @if($consult->presentingComplaints()->count())
        @foreach ($consult->presentingComplaints as $consult)
            <div class="block block-bordered">
                <div class="block-header bg-info-light">
                    <h4>Presenting Complaints History  For {{$appointment->user->full_name ?? ''}} </h4>
                    <p> recorded on {{$consult->created_at->format('d-M-Y H:i A')}} by
                        <span class="badge badge-secondary">{{ $consult->seenBy->name ?? '' }}</span>  <br> </p>
                </div>
                <div class="block-body">
                    <h3 class="block-title textcenter">Presumptive Diagnosis</h3>
                    <h3 class="text-center">
                        {{$consult->presumptive_diagnosis }}
                    </h3>
                    <div class="row gutters-tiny">
                        <div class="col-md-8">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Presenting Complaints</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->pc}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Duration</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->duration}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">History of presenting complaints</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->pchx }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Past Medical History</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->pmhx }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Family and Social History</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->fshx }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Previously admitted</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->previously_admitted }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($consult->previously_admitted == 'yes')
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Reasons for Admission</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->reasons4admission}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">History of Hypertension</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->hypertensive ? 'True' : 'False' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">History of Diabetes</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->diabetic ? 'True' : 'False' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Previous Blood transfusion</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->blood_transfusion ? 'True' : 'False' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">History of Sickle Cell</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->sc_disease ? 'True' : 'False' }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($consult->drug_or_allergy)
                            <div class="col-md-6">
                                <div class="block block-themed">
                                    <div class="block-header">
                                        <h3 class="block-title text-center">History of Drug/allergy</h3>
                                    </div>
                                    <div class="block-content">
                                        <p>{{ $consult->drug_or_allergy}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($consult->others)
                            <div class="col-md-6">
                                <div class="block block-themed">
                                    <div class="block-header">
                                        <h3 class="block-title text-center">Others</h3>
                                    </div>
                                    <div class="block-content">
                                        <p>{{ $consult->others}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title bg-secondary text-center">Systemic Review</h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Central Nervous System(CNS) </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->cns}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Cardio vascular System(CVS) </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->cvs}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Respiratory System(RS) </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->resp_system}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Gastro Intestinal System (GIT) </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->git}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Urinary System(US) </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->urinary_system }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Obstetrics &amps; Gynaecology (OBGYN) </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->obgyn}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Musculo Skeletal System </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->mss}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Skin </h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->skin}}</p>
                                </div>
                            </div>
                        </div>


                    </div>

                    <button class="btn btn-action" id="phx">take a new History</button>
                </div>
            </div>
        @endforeach
    @endif
 @endforeach
@endif
