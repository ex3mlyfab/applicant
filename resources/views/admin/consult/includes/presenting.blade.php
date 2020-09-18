
    <!-- Progress Wizard 2 -->
    <div class="js-wizard-simple block block">
        <!-- Wizard Progress Bar -->
        <div class="progress rounded-0" data-wizard="progress" style="height: 8px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <!-- END Wizard Progress Bar -->

        <!-- Step Tabs -->
        <ul class="nav nav-tabs nav-tabs-alt nav-justified text-uppercase" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#wizard-progress2-step1" data-toggle="tab">A. History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#wizard-progress2-step2" data-toggle="tab">4. Past Medical History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#wizard-progress2-step3" data-toggle="tab">5. Systemic Review</a>
            </li>
        </ul>
        <!-- END Step Tabs -->

        <!-- Form -->
    <form action="{{route('pc.store')}}" method="POST">
            @csrf
    <input type="hidden" name="clinical_appointment_id" value="{{$appointment->id}}">
    <input type="hidden" name="encounter_id" value={{$encounter->id}}>
            <!-- Steps Content -->
            <div class="block-content block-content-full tab-content px-md-5" style="min-height: 314px;">
                <!-- Step 1 -->
                <div class="tab-pane active" id="wizard-progress2-step1" role="tabpanel">
                    <div class="form-row">
                        <div class="form-group col-md-8 bg-amethyst-light p-2">
                            <label for="pc">1. Presenting Complaints</label>
                            <textarea name="pc" id="pc"  rows="4" class="form-control">{{old('pc') ?? ''}}</textarea>
                        </div>
                        <div class="form-group col-md-4 bg-amethyst-lighter p-2">
                            <label for="duration">Duration</label>
                            <input type="text" name="duration" id="duration" class="form-control form-control-lg">
                        </div>
                    </div>

                    <div class="form-group bg-flat-lighter p-2">
                        <label for="pchx">2. History of Presenting Complaints</label>
                        <textarea name="pchx" id="pchx"  rows="4" class="form-control">{{old('pchx') ?? ''}}</textarea>
                    </div>

                    <div class="form-group bg-city-lighter p-2">
                        <label for="fshx">3. Family and Social History</label>
                        <textarea name="fshx" id="fshx"  rows="4" class="form-control">{{old('fshx') ?? ''}}</textarea>
                    </div>
                </div>
                <!-- END Step 1 -->

                <!-- Step 2 -->
                <div class="tab-pane" id="wizard-progress2-step2" role="tabpanel">

                            <div class="form-group form-row bg-city-lighter p-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="previously_admitted"> Ever been Admitted ? :</label>
                                        <div class="form-check">
                                            <input type="radio" name="previously_admitted" id="radio123" class="form-check-input" value="yes">
                                            <label for="radio123" class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="previously_admitted" id="radio234" class="form-check-input" value="no">
                                            <label for="radio234" class="form-check-label">No</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="previously_admitted" id="radio234" class="form-check-input" value="Cannot Remember">
                                            <label for="radio234" class="form-check-label">Cannot Remember</label>
                                        </div>
                                    </div>

                                        <input type="text" name="reasons4admission" class="form-control form-control-lg" placeholder="If yes?  reasons for admission" id="username123" value="{{old('reasons4admission') ?? ''}}">

                                </div>
                                    <div class="col-md-4">
                                        <label for="pas123" >History of hypertension :</label>
                                        <input type="text" name="hypertensive" class="form-control form-control-lg" id="pas123" value="{{old('hypertensive') ?? ''}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password123">History of Diabetes <br>:</label>
                                        <input type="text" name="diabetic" class="form-control form-control-lg" id="password123" value="{{old('diabetic') ?? ''}}">
                                    </div>

                            </div>


                    <div class="form-group form-row bg-modern-lighter p-2">
                        <div class="col-md-4">
                            <label for="passwrd123" >Previous Blood transfusion :</label>
							<input type="text" name="blood_transfusion" class="form-control form-control-lg" id="passwrd123" value="{{old('blood_transfusion') ?? ''}}">
                        </div>
                        <div class="col-md-4">
                            <label for="pasword123">History of Drug/Allergy :</label>
								<input type="text" name="drug_or_allergy" class="form-control form-control-lg" id="pasword123" value="{{old('drug_or_allergy') ?? ''}}" >
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
								<label for="paswod123" class="form-control-label-lg">Sickle cell Disease <br>:</label>
                                <input type="text" name="sc_disease" class="form-control form-control-lg" id="paswod123" value="{{old('sc_disease') ?? ''}}" >

							</div>
                        </div>
                    </div>
                    <div class="form-group bg-primary-lighter p-2 ">
                        <label for="paswd123" class="form-control-label-lg">Others:</label>
                        <input type="text" name="others" class="form-control form-control-lg" id="paswd123" value="{{old('others') ?? ''}}">
                    </div>
                </div>
                <!-- END Step 2 -->

                <!-- Step 3 -->
                <div class="tab-pane" id="wizard-progress2-step3" role="tabpanel">
                    <div class="form-group form-row bg-smooth-lighter p-2">
                        <div class="col-md-4">
                            <label for="cns" >Central Nervous System(CNS) :</label>
								<input type="text" name="cns" class="form-control form-control-lg" id="cns" value="{{old('cns') ?? ''}}">
                        </div>
                        <div class="col-md-4">
                            <label for="cvs">Cardio-Vascular System (cvs) </label>
							<input type="text" name="cvs" class="form-control form-control-lg" id="cvs" placeholder="" value="{{old('cvs') ?? ''}}">
                        </div>
                        <div class="col-md-4">
                            <label for="rs" >Respiratory System  <br> (rs) </label>
							<input type="text" name="resp_system" class="form-control form-control-lg" id="rs" placeholder="" value="{{old('resp_system') ?? ''}}">
                        </div>

                    </div>
                    <div class="form-group form-row bg-flat-lighter p-2">
                        <div class="col-md-4">
                            <label for="git" >GIT </label>
							<input type="text" name="git" class="form-control form-control-lg" id="git" placeholder="" value="{{old('git') ?? ''}}">
                        </div>
                        <div class="col-md-4">
                            <label for="us">Urinary System :</label>
							<input type="text" name="urinary_system" class="form-control form-control-lg" id="us" value="{{old('urinary_system') ?? ''}}" >
                        </div>
                        <div class="col-md-4">
                            <label for="obgyn">ObGyn :</label>
                            <input type="text" name="obgyn" class="form-control form-control-lg" id="obgyn" value="{{old('obgyn') ?? ''}}">

                        </div>

                    </div>
                    <div class="form-group form-row bg-city-light p-2">
                        <div class="col-md-6">
                            <label for="mss">MusculoSkeletal System :</label>
							<input type="text" name="mss" class="form-control form-control-lg" id="mss" value="{{old('mss') ?? ''}}">
                        </div>
                        <div class="col-md-6">
                            <label for="skin" >Skin:</label>
                            <input type="text" name="skin" class="form-control form-control-lg" id="skin"
                            value="{{old('mss') ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group bg-modern-lighter p-2">
                        <label for="pd">Presumptive Diagnosis:</label>
                        <input type="text" name="presumptive_diagnosis" class="form-control form-control-lg" id="pd" required value="{{old('pd') ?? ''}}">
                    </div>

                <!-- END Step 3 -->
                </div>
            <!-- END Steps Content -->

            <!-- Steps Navigation -->
            <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary" data-wizard="prev">
                            <i class="fa fa-angle-left mr-1"></i> Previous
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-secondary" data-wizard="next">
                            Next <i class="fa fa-angle-right ml-1"></i>
                        </button>
                        <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                            <i class="fa fa-check mr-1"></i> Submit
                        </button>
                    </div>
                </div>
            </div>
            <!-- END Steps Navigation -->
        </form>
        <!-- END Form -->
    </div>
    <!-- END Progress Wizard 2 -->
    </div>
