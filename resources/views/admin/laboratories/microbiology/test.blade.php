@extends('admin.admin')
@section('head_css')
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection
@section('title')
    record test result
@endsection

@section('content')
<div class="content">
    <div class="block block-fx-shadow">
        <div class="block-header bg-info-light">

        </div>
    </div>
    <div class="block-content block-content-full">
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
        <form action="{{route('microreq.store')}}" method="post" class="bg-flat text-white px-2">
                @csrf
            <div class="form-group">
                <label for="specimen"> Nature of Specimen</label>
                <input type="text" name="specimen" id="specimen"
            value="{{$number->specimen}}" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="clinical_information"> Diagnosis and Clinical Details</label>
                <textarea type="text" name="clinical_information" id="clinical_information" class="form-control">{{$number->clinical_information ?? ''}}</textarea>
            </div>
            <div class="form-group">
                <label for="examination_required"> investigation required</label>
            <input type="text" name="examination_required" id="examination_required" class="form-control form-control-lg" value="{{$number->examination_required}}" readonly>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="2">
                            <label for="date_recieved">Date Recieved</label>
                            <input type="text" name="date_recieved" id="date_recieved" class="js-datepicker form-control" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" >
                        </td>
                        <td rowspan="2">
                            <label>Lab: No:</label>
                            <input type="text" name="lab_no" class="form-control">
                        </td>
                        <td style="width:5%;" rowspan="2">
                        SBL</td>
                        <td rowspan="2">
                            Drugs
                        </td>
                        <td colspan="3">
                            isolates
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">2</td>
                        <td class="text-center">3</td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td colspan="2" rowspan="20">
                            <label>
                                Results/Reports:
                            </label>
                            <textarea name="result" class="form-control" ></textarea>
                        </td>
                        <td>
                            AUG
                        </td>
                        <td>
                            AUGMENTIN
                        </td>
                        <td>
                            <input type="text" name="augmentin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="augmentin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="augmentin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            CFM
                        </td>
                        <td>
                            CEFIXIME
                        </td>
                        <td>
                            <input type="text" name="cefixime[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="cefixime[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="cefixime[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            E
                        </td>
                        <td>
                            ERYTHROMYCIN
                        </td>
                        <td>
                            <input type="text" name="erythromycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="erythromycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="erythromycin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            AZM
                        </td>
                        <td>
                            AZITHROMYCIN
                        </td>
                        <td>
                            <input type="text" name="azythromycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="azythromycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="azythromycin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            IM
                        </td>
                        <td>
                            IMIPENEM
                        </td>
                        <td>
                            <input type="text" name="imipenem[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="imipenem[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="imipenem[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            G
                        </td>
                        <td>
                            GENTAMYCIN
                        </td>
                        <td>
                            <input type="text" name="gentamycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="gentamycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="gentamycin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            OFX
                        </td>
                        <td>
                            OFLOXACIN
                        </td>
                        <td>
                            <input type="text" name="ofloxacin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="ofloxacin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="ofloxacin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            CIP
                        </td>
                        <td>
                            CIPROFLOXACIN
                        </td>
                        <td>
                            <input type="text" name="ciprofloxacin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="ciprofloxacin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="ciprofloxacin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            CXM
                        </td>
                        <td>
                            CEFUROXIM
                        </td>
                        <td>
                            <input type="text" name="cefuroxim[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="cefuroxim[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="cefuroxim[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            CRO
                        </td>
                        <td>
                            CEFTRIAXONE
                        </td>
                        <td>
                            <input type="text" name=ceftriaxone[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=ceftriaxone[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=ceftriaxone[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            CD
                        </td>
                        <td>
                            CLINDAMYCIN
                        </td>
                        <td>
                            <input type="text" name=clindamycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=clindamycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=clindamycin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                            CAZ
                        </td>
                        <td>
                           CEFTAZIDIME
                        </td>
                        <td>
                            <input type="text" name=ceftazidime[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=ceftazidime[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=ceftazidime[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           PTZ
                        </td>
                        <td>
                           PIPERACILLIN/TAZO
                        </td>
                        <td>
                            <input type="text" name=piperacillin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=piperacillin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=piperacillin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           MEM
                        </td>
                        <td>
                           MEROPENEM
                        </td>
                        <td>
                            <input type="text" name=meropenem[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=meropenem[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=meropenem[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           VA
                        </td>
                        <td>
                           VANCOMYCIN
                        </td>
                        <td>
                            <input type="text" name=vancomycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=vancomycin[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=vancomycin[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           NIT
                        </td>
                        <td>
                           NITROFURATION
                        </td>
                        <td>
                            <input type="text" name=nitrofuration[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=nitrofuration[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=nitrofuration[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           TGC
                        </td>
                        <td>
                           TIGECYCLINE
                        </td>
                        <td>
                            <input type="text" name=tigecycline[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=tigecycline[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=tigecycline[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           SYN
                        </td>
                        <td>
                           SYNERCID
                        </td>
                        <td>
                            <input type="text" name=synercid[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=synercid[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=synercid[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           CTZ
                        </td>
                        <td>
                           CEFTAZIDIME/TAZO
                        </td>
                        <td>
                            <input type="text" name=ceftazidime_tazo[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=ceftazidime_tazo[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=ceftazidime_tazo[]" class="form-control">
                        </td>
                    </tr>
                    <tr class="text-size-sm" style="padding:0; margin:0;">
                        <td>
                           CRZ
                        </td>
                        <td>
                          CETRIAXONE/TAZO
                        </td>
                        <td>
                            <input type="text" name=cetriaxone_tazo[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=cetriaxone_tazo[]" class="form-control">
                        </td>
                        <td>
                            <input type="text" name=cetriaxone_tazo[]" class="form-control">
                        </td>
                    </tr>


                </table>
            </div>

            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </form>

    </div>
</div>

@endsection

@section('foot_js')
<script src="{{asset('public/backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script>jQuery(function(){ One.helpers(['datepicker']); });</script>

@endsection

