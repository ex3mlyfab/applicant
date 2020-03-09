<div class="block block-bordered block-fx-pop">
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
    </div>
</div>
