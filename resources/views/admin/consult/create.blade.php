@extends('admin.admin')

@section('title')
    consultation
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('public/backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')
    <div class="content">
        <div class="row gutters-tiny">
            <div class="col-md-2">
                <div class="block block-bordered block-rounded block-fx-shadow">
                    <div class="block-content">
                        <img class="img-fluid img-fluid-100 options-item" src="{{asset('public/backend')}}/images/avatar/{{$patient->avatar}}" alt="">
                        <div class="table-responsive">
                            <table class="table table-borderless table-vcenter">
                                <tbody>
                                    <tr class="mb-0">

                                        <td>{{$patient->full_name}}</td>

                                    </tr>
                                    <tr>

                                        <td>{{$patient->folder_number}}</td>

                                    </tr>
                                    <tr>

                                        <td>{{$patient->sex}}</td>
                                    </tr>
                                    <tr>

                                        <td>{{$patient->age}}</td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('admin.consult.includes.vitalsigns')
            </div>
            <div class="col-md-10">
                <div class="block block-fx-pop">
                    <div class="block-content block-content-full">
                         <!-- Block Tabs Alternative Style -->
                         <div class="block">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-home">Presenting Complaints</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-profile">Physical Exam</a>
                                </li>
                                @if (($consults->count() > 1))
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-followup">Follow Up</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-action">Action Plan</a>
                                </li>

                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                                    <h4 class="font-w400">Presenting Complaints</h4>

                                    <span class="presenting">
                                    @include('admin.consult.includes.presenting')
                                    </span>
                                    @include('admin.consult.includes.presentingHistory')

                                </div>
                                <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                                    <h4 class="font-w400">Physical Exams</h4>

                                    <span class="physical">
                                    @include('admin.consult.includes.physical')
                                    </span>
                                    @include('admin.consult.includes.physicalHistory')
                                </div>
                                @if (($consults->count() > 1))
                                    <div class="tab-pane" id="btabs-alt-static-followup" role="tabpanel">
                                    <h4 class="font-w400">Follow Up </h4>

                                        @include('admin.consult.includes.followupHistory')


                                    @include('admin.consult.includes.followup')


                                </div>
                                @endif

                                <div class="tab-pane" id="btabs-alt-static-action" role="tabpanel">
                                    <h4 class="font-w400">Action Plans</h4>
                                    @include('admin.consult.includes.actions')
                                    @include('admin.consult.includes.modal')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot_js')
<!-- Page JS Plugins -->
<script src="{{asset('public/backend')}}/assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/jquery-validation/additional-methods.js"></script>
<script src="{{asset('public/backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Page JS Code -->
<script src="{{asset('public/backend')}}/assets/js/pages/be_forms_wizard.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker']); });</script>
<script>
    $(function(){
            $('#specify').hide();
            $('#specify_symptoms').hide();

            $('#username123').hide();
            $('#radio123').on('click', function(){
                $('#username123').show();
            });
            $('#radio234').on('click', function(){
                $('#username123').hide();
            });
            @if($consults->count() >= 1)
               @foreach($consults as $consult)
               @if($consult->presentingComplaint)
               $('.presenting').hide();
               @endif
               @if($consult->physicalExam)
               $('.physical').hide();
               @endif
               @endforeach


            @endif
            $('#phx').on('click', function(){
                $('.presenting').toggle();
            });
            $('#physical').on('click', function(){
                $('.physical').toggle();
            });
            $('#fbc').change(function(){
                if(this.checked){

                    $('.fbc').prop("checked",true );
                    $('#investigation_required').val('Full Blood Count');
                }
            });
            $('.specimen').bind('change', function(){
                if(this.checked){
                    $('#specify').hide();
                }
            });
            $('#others').change(function(){
                if(this.checked){
                    $('#specify').show();    
                }
            });
            $('#specify').on('blur', function(){
                var valid = $(this).val();
                $('input[name="specimen_type"]').val(valid);
                console.log($('input[name="specimen_type"]').val());
            });
    });
    function addRow()
{
    var tr='<tr>'+
            '<td><input type="text" name="medicine[]" class="form-control form-control-lg"></td>'+
            '<td><input type="text" name="quantity[]" class="form-control form-control-lg"></td>'+
            '<td><input type="text" name="dosage[]" class="form-control form-control-lg"></td>'+

            '<td class="remove" style="text-align: center"><a href="#" class="btn btn-danger" onclick="deleteRow()"><i class="fa fa-times"></i></a></td>'+
            '</tr>';

    $('#drugs tbody').append(tr);
}

function deleteRow()
{
    $(document).on('click', '.remove', function()
    {
        $(this).parent('tr').remove();
    });
}

</script>


@endsection
