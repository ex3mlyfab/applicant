@if ($patient->encounters->count()>=1)
@foreach ($patient->encounters as $tree)
    @if($tree->physicalExams()->count())
        @foreach ($tree->physicalExams as $consult)
            <div class="block block-bordered">
                <div class="block-header bg-info-light">
                    <h4>Physical Examination History  For {{$appointment->user->full_name}} </h4>
                    <p> recorded on {{$consult->created_at->format('d-M-Y H:i A')}} by
                        <span class="badge badge-secondary">{{ $consult->seenBy->name ?? '' }}</span>  <br> </p>

                </div>
                <div class="block-body">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <h3 class="bg-aqua">
                                Presumptive Diagnosis
                            </h3>
                            <p>{{$tree->presentingComplaints->last()->presumptive_diagnosis ?? ''}}</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="bg-aqua">
                                Initial Diagnosis
                            </h3>
                            <p>{{$consult->initial_diagnosis}}</p>
                        </div>
                    </div>

                    <div class="row gutters-tiny">
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> General Examination:</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->general_exam}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Local Exam :</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->local_exam}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Regional Exam :</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->regional_exam}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title bg-secondary text-center">Systemic Review</h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Central Nervous System(CNS)</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->cns}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Cardio vascular System(CVS)</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->cvs}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Respiratory System(RS)</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->resp_system}}</p>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Abdomen</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->abdomen}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Genito-Urinary-Tract inc. VE</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->gut}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Musculo Skeletal System</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->musculo_skeletal}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center"> Inittial Diagnosis</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ $consult->initial_diagnosis}}</p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <button class="btn btn-action" id="physical">Take a new Physical Exam</button>
                </div>
            </div>
        @endforeach
    @endif
@endforeach




@endif
