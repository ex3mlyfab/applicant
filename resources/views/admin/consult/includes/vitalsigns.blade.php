<div class="block block-bordered block-fx-pop">
    <p class="font-size-3 bg-white text-black text-center mb-0">Vital Signs</p>

    <div class="block-content block-content-full bg-flat-lighter text-white">
        <ul class="nav-items push">

            <li>
                <div class="font-size-sm text-muted ">Blood pressure</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->systolic}}/{{$patient->vitalSigns->first()->diastolic}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">Temperature:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->temp}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">Respiratory Rate:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->rr}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">Pulse Rate:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->pr}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">weight:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->weight}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">height:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->height}}</div>
                </div>

            </li>
            <li>
                <div class="font-size-sm text-muted ">bmi:</div>
                <div class="media-body">
                    <div class="font-w600">{{$patient->vitalSigns->first()->bmi}}</div>
                </div>

            </li>
        </ul>
        <p class="font-size-4 bg-white text-black text-center">Taken : {{$patient->vitalSigns->first()->created_at->diffForHumans()}}<br><span class="font-size-4 bg-smooth-lighter text-white text-center m-0 p-0">at : {{$patient->vitalSigns->first()->created_at->format('d-M-Y, H:i:s')}}</span></p>

    </div>


    <button type="button" class="btn btn-md btn-danger w-100 takevitals" data-toggle="modal"  data-target="#vital-signs" data-pictures="{{asset('backend')}}/images/avatar/{{$patient->avatar}}" data-fullname="{{ $patient->full_name}}" data-patient-id="{{$patient->id}}" data-folder-no="{{ $patient->folder_number}}" data-sex="{{ $patient->sex}}">
        <span data-toggle="tooltip" title="take vitals sign"> <i class="fa fa-fw fa-2x fa-stopwatch"></i></span>
    </button>
</div>
<div class="block block-bordered bg-danger pentacare-bg">
    @if ($patient->allergies->count() > 0)
        <h3 class="text-danger bg-white">Patient Reacts To:</h3>

            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($patient->allergies as $item)
                        <tr>
                            <td width="80%">
                                {{$item->name}}
                            </td>
                            <td>
                                <form action="{{route('allergy.remove', $item->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete expense" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    @endif
    <button type="button" class="btn mr-2 btn-md mb-2 text-uppercase" data-toggle="modal" data-target="#allergy-block-normal" style="background-color: #cb9696;">Add Reactions</button>
</div>
