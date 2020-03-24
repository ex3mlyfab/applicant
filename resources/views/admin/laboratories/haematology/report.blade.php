@extends('name')

@section('title')
    Haematology Report
@endsection

@section('content')
<div class="content content-boxed">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Laboratory Report for {{$number->clinicalAppointment->user->full_name}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Helpers.print() -->
                <button type="button" class="btn-block-option" onclick="One.helpers('print');">
                    <i class="si si-printer mr-1"></i> Print Laboratory Report
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="text-center">
                <img src="{{asset('public/backend')}}/images/pentacare.png" style="width:100px;" class="img-fluid img-avatar-rounded">
            </div>
            <div class="block block-fx-pop">
                <div class="block-header bg-info-dark"></div>
                <div class="block-content ">
                    <div class="row">
                        <div class="col-md-4 text-center">
                             <img src="{{asset('public/backend')}}/images/avatar/{{$number->clinicalAppointment->user->avatar}}" alt="" class="img-avatar img-avatar96">
                        </div>
                        <div class="col-md-8 font-size-sm">
                             <p class="my-0"> Name:&nbsp;<strong>{{$number->clinicalAppointment->user->full_name}}</strong></p>
                            <p class="mb-0">F/No:&nbsp; <strong> {{$number->clinicalAppointment->user->folder_number}}</strong></p>
                            <p class="mb-0">Sex:&nbsp;{{$number->clinicalAppointment->user->sex}}</p>
                            <p>Age:&nbsp; {{$number->clinicalAppointment->user->age}}</p>

                        </div>
                    </div>

                </div>
            </div>

                <div class="form-group form-row">

                    <div class="col-md-3">
                        <label for="clinical_details">Clinical Details</label>
                    <input type="text" name="clinical_details" id="clinical_details" class="form-control" value="{{$number->clinical_details}}" disabled>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mt-4">
                            <input type="checkbox" name="fbc" id="fbc" class="custom-control-input" value="fbc" @if ($number->fbc)
                                checked
                            @endif disabled><label for="fbc" class="custom-control-label">FBC</label>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <label for="investigation_required">Investigation Required</label>
                    <input type="text" name="investigation_required" id="investigation_required" class="form-control" value="{{$number->investigation_required}}" disabled>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="hb" id="hb" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled>
                            <label for="hb" class="custom-control-label">Hb</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                <input type="text" name="hb_value" id="hb_value" class="form-control" value="{{$number->hb_value}}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"> g/dl</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Anisocytosis</span>
                                    </div>

                                    <input type="text" name="anisocytosis" id="anisocytosis" class="form-control form-control-alt" {{$number->anisocytosis}} readonly>

                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Target Cells</span>
                                    </div>

                                <input type="text" name="target_cells" id="target_cells" class="form-control form-control-alt" value="{{ $number->target_cells}}" readonly>

                                </div>
                            </td>
                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">BLAST</span>
                                    </div>

                                    <input type="text" name="blast" id="blast" class="form-control" value="{{ $number->blast}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr class="m-0 p-0">
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="pcv" id="pcv" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="pcv" class="custom-control-label">PCV</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="pcv_value" id="pcv_value" class="form-control" value="{{ $number->pcv_value}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">poikilocytosis</span>
                                    </div>

                                    <input type="text" name="poikilocytosis" id="poikilocytosis" class="form-control form-control-alt" value="{{ $number->poikilocytosis}}" readonly >

                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Sickle Cells</span>
                                    </div>

                                    <input type="text" name="sickle_cells" id="sickle_cells" class="form-control form-control-alt" value="{{ $number->sickle_cells}}" readonly>

                                </div>
                            </td>
                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PROMYEL</span>
                                    </div>

                                    <input type="text" name="promyel" id="promyel" class="form-control" value="{{ $number->promyel }}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr class="m-0 p-0">
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="rbc" id="rbc" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="rbc" class="custom-control-label">RBC</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="rbc_value" id="rbc_value" class="form-control" value="{{ $number->rbc_value}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> X15 <sup>12/1</sup></span>
                                    </div>

                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Microcytosis</span>
                                    </div>

                                    <input type="text" name="microcytosis" id="microcytosis" class="form-control form-control-alt" value="{{ $number->microcytosis}}" readonly >

                                </div>
                            </td>
                            <td rowspan="2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Nucleated RBC</span>
                                    </div>

                                    <input type="text" name="nucleated_rbc" id="nucleated_rbc" class="form-control form-control-alt" value="{{ $number->nucleated_rbc }}" readonly >

                                </div>
                            </td>
                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">MYEL</span>
                                    </div>

                                    <input type="text" name="myel" id="myel" class="form-control" value="{{ $number->myel }}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="mcv" id="mcv" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="mcv" class="custom-control-label">MCV</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="mcv_value" id="mcv_value" class="form-control"  value="{{ $number->mcv_value}}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"> fi</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Macrocytosis</span>
                                    </div>

                                    <input type="text" name="macrocytosis" id="macrocytosis" class="form-control form-control-alt" value="{{ $number->macrocytosis}}" readonly >

                                </div>
                            </td>

                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">METAMYEL</span>
                                    </div>

                                    <input type="text" name="metamyel" id="metamyel" class="form-control" value="{{ $number->metamyel}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="mch" id="mch" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="mch" class="custom-control-label">MCH</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="mch_value" id="mch_value" class="form-control" value="{{ $number->mch_value}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> pg</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Hypochromia</span>
                                    </div>

                                    <input type="text" name="hypochromia" id="hypochromia" class="form-control form-control-alt" value="{{ $number->hypochromia}}" readonly >

                                </div>
                            </td>
                            <td rowspan="2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">Plat (on film)</span>
                                    </div>

                                    <input type="text" name="plat_on_film" id="plat_on_film" class="form-control form-control-alt" value="{{ $number->plat_on_film}}" readonly >

                                </div>
                            </td>
                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">NEUT</span>
                                    </div>

                                    <input type="text" name="neut" id="neut" class="form-control" value="{{ $number->neut}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="mchc" id="mchc" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="mchc" class="custom-control-label">MCHC</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="mchc_value" id="mchc_value" class="form-control" value="{{ $number->mchc_value }}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> g/dl</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-alt">polychromasia</span>
                                    </div>

                                    <input type="text" name="polychromasia" id="polychromasia" class="form-control form-control-alt" value="{{ $number->polychromasia}}" readonly>

                                </div>
                            </td>

                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">LYMPH</span>
                                    </div>

                                    <input type="text" name="lymph" id="lymph" class="form-control" value="{{ $number->lymph}}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="retic" id="retic" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="retic" class="custom-control-label">Retic</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="retic_value" id="retic_value" class="form-control" value="{{ $number->retic_value }}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" rowspan="3">
                                <label for="result" class="bg-gray-light px-1">Other Results/Comment</label>
                                <textarea name="other_result" id="result" rows="10" class="form-control">{{ $number->target_cells ?? ""}}</textarea>
                            </td>

                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">MONO</span>
                                    </div>

                                    <input type="text" name="mono" id="mono" class="form-control" value="{{ $number->mono }}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="wbc" id="wbc" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="wbc" class="custom-control-label">WBC</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="wbc_value" id="wbc_value" class="form-control" value="{{ $number->wbc_value }}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text">X15 <sup>9/1</sup> </span>
                                    </div>
                                </div>
                            </td>

                            <td class="table-bordered border-info">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">EOSIN</span>
                                    </div>

                                    <input type="text" name="eosin" id="eosin" class="form-control" value="{{ $number->eosin }}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="plat" id="plat" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="plat" class="custom-control-label">plat</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="plat_value" id="plat_value" class="form-control" value="{{ $number->plat_value }}" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"> X15 <sup>9/1</sup></span>
                                    </div>
                                </div>
                            </td>

                            <td class="table-bordered border-info" rowspan="2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">BASO</span>
                                    </div>

                                    <input type="text" name="baso" id="baso" class="form-control" value="{{ $number->baso }}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"> %</span>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;" class="pr-0 mr-0">
                                <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg  mb-1 fbc">
                                <input type="checkbox" name="esr" id="esr" class="custom-control-input fbc" @if ($number->fbc)
                                checked
                            @endif disabled ><label for="esr" class="custom-control-label">esr</label>
                                </div>
                            </td>
                            <td style="width:15%;" class="pl-0 ml-0">
                                <div class="input-group">

                                    <input type="text" name="esr_value" id="esr_value" class="form-control" value="{{ $number->esr_value}}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>

        </div>
        </div>


    </div>
</div>

@endsection
