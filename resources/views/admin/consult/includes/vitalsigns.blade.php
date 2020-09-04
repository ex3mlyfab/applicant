<dsiv class="block block-bordered block-fx-pop">
    <p class="font-size-3 bg-white text-black text-center mb-0">Vital Signs</p>

    <div class="block-content block-content-full bg-flat-lighter text-white">
        <ul class="nav-items push">

            <li>
                <div class="font-size-sm text-muted ">Blood pressure</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->systolic}}/{{$patient->vitalSigns->last()->diastolic}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">Temperature:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->temp}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">Respiratory Rate:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->rr}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">Pulse Rate:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->pr}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">weight:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->weight}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">height:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->height}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">bmi:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->last()->bmi}}</div>
                </div>

            </li>
        </ul>
        <p class="font-size-4 bg-white text-black text-center">Taken : {{$patient->vitalSigns->last()->created_at->diffForHumans()}}<br><span class="font-size-4 bg-smooth-lighter text-white text-center m-0 p-0">at : {{$patient->vitalSigns->last()->created_at->format('d-M-Y, H:i:s')}}</span></p>

    </div>


    <button type="button" class="btn btn-md btn-danger w-100 takevitals" data-toggle="modal"  data-target="#vital-signs" data-pictures="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" data-fullname="{{ $patient->full_name}}" data-patient-id="{{$patient->id}}" data-folder-no="{{ $patient->folder_number}}" data-sex="{{ $patient->sex}}">
        <span data-toggle="tooltip" title="take vitals sign"> <i class="fa fa-fw fa-2x fa-stopwatch"></i></span>
    </button>
</dsiv>
